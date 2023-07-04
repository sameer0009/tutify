/*
 * @Author: ZegoDev
 * @Date: 2021-07-29 12:57:58
 * @LastEditTime: 2021-09-10 11:07:07
 * @LastEditors: Please set LastEditors
 * @Description: Room login and logout related
 * @FilePath: /superboard/js/login/login.js
 */

var userList = []; // List of members in the room

/**
 * @description: Listen for zegoEngine.
 */
function onZegoEngineEvent() {
    zegoEngine.on('roomUserUpdate', function (roomID, type, list) {
        if (type == 'ADD') {
            list.forEach(function (v) {
                userList.push({
                    userID: v.userID,
                    userName: v.userName
                });
            });
        } else if (type == 'DELETE') {
            list.forEach(function (v) {
                var index = userList.findIndex(function (item) {
                    return v.userID == item.userID;
                });
                if (index != -1) {
                    userList.splice(index, 1);
                }
            });
        }
        // Update the room member list dialog on the room page.
        loginUtils.updateUserListDomHandle(userList);
    });

    zegoEngine.on('tokenWillExpire', async function (roomID) {
        console.log('mytag tokenWillExpire');
        var newtoken = await loginUtils.getToken(36000)
        zegoEngine.renewToken(newtoken)
        zegoSuperBoard.renewToken(newtoken)
        var loginInfo = JSON.parse(sessionStorage.getItem('loginInfo'))
        loginInfo.token = newtoken
        sessionStorage.setItem('loginInfo', JSON.stringify(loginInfo))
    })
}

/**
 * @description: After successful login, add yourself to the member list.
 */
function pushOwn() {
    userList.unshift({
        userID: zegoConfig.userID,
        userName: zegoConfig.userName
    });
    // Update the room member list dialog on the room page.
    loginUtils.updateUserListDomHandle(userList);
}

/**
 * @description: Log in to the room.
 * @param {String} token
 */
async function loginRoom(token) {
    try {
        // Register, listen for
        onZegoEngineEvent();
        // Log in to the room.
        await zegoEngine.loginRoom(
            zegoConfig.roomID,
            token, {
                userID: zegoConfig.userID,
                userName: zegoConfig.userName
            }, {
                maxMemberCount: 10,
                userUpdate: true
            }
        );
        // After successful login, add yourself to the member list.
        pushOwn();

        // Register the Superboard callback. (method in the room)
        onSuperBoardEventHandle();
    } catch (error) {
        console.error(error);
    }
}

/**
 * @description: Verify input roomID and userName.
 * @returns {Object|Boolean} When verification passed, { roomID: string; userName: string } is returned. When verification failed, false is returned.
 */
function checkInput() {
    var roomID = $('#roomID').val();
    var userName = $('#userName').val();
    var userID = $('#userID').val()
    if (!userName || !roomID || !userID) {
        alert('Please enter username, room ID and userID');
        return false;
    }
    return {
        roomID,
        userName,
        userID
    };
}

/**
 * @description: Leave the room.
 */
function logoutRoom() {
    // Leave the room.
    zegoEngine.logoutRoom(zegoConfig.roomID);
    // Clear sessionStorage.
    sessionStorage.removeItem('loginInfo');
    // Clear the member list.
    userList = [];
    // Display the login page.
    loginUtils.togglePageDomHandle(false);
    // Clear the SuperboardSubView mounted on the page.
    $('#main-whiteboard').html('');
    // Clear the SuperboardSubView drop-down list on the page. (method in the room).
    roomUtils.updateWhiteboardListDomHandle([]);
    // Clear the Excel sheet drop-down list on the page. (method in the room).
    roomUtils.toggleSheetSelectDomHandle(false);
    // Display the SuperboardSubView placeholder on the page. (method in the room).
    roomUtils.togglePlaceholderDomHandle(true);
    // Hide the thumbnail icon. (method in the room).
    roomUtils.toggleThumbBtnDomHandle(false);
    // Clear the thumbnail list. (method in the room).
    flipToPageUtils.updateThumbListDomHandle([]);
}

// Bind the room login event.
$('#login-btn').click(async function () {
    // Verify input roomID, userName, and userID.
    var result = checkInput();
    if (!result) return;
    // Obtain configuration information set on the page. layui is used here. The return values are as follows. You can obtain it as required.
    // {
    //     dynamicPPT_AutomaticPage: "true",
    //     dynamicPPT_HD: "false",
    //     fontFamily: "system",
    //     pptStepMode: "1",
    //     superBoardEnv: "test",
    //     disableH5ImageDrag: "false",
    //     thumbnailMode: "1",
    //     unloadVideoSrc: "false",
    // }
    var settingData = layui.form.val('settingForm');
    // Obtain the selected access environment.
    var env = $('.inlineRadio:checked').val();
    var loginInfo = {
        env,
        roomID: result.roomID,
        userName: result.userName,
        userID: result.userID,
        // userID: zegoConfig.userID,
        superBoardEnv: settingData.superBoardEnv,
        fontFamily: settingData.fontFamily,
        disableH5ImageDrag: settingData.disableH5ImageDrag,
        thumbnailMode: settingData.thumbnailMode,
        pptStepMode: settingData.pptStepMode,
        dynamicPPT_HD: settingData.dynamicPPT_HD,
        dynamicPPT_AutomaticPage: settingData.dynamicPPT_AutomaticPage,
        unloadVideoSrc: settingData.unloadVideoSrc
    };
    // Update local zegoConfig.
    Object.assign(zegoConfig, loginInfo);
    try {
        // Initialize the SDK.
        var token = await initZegoSDK();
        // Log in to the room.
        await loginRoom(token);
        // Store sessionStorage.
        sessionStorage.setItem('loginInfo', JSON.stringify(loginInfo));
        // Update the page URL.
        loginUtils.updateUrl('roomID', loginInfo.roomID, 'env', loginInfo.env), 'userID', loginInfo.userID;
        // Display the room page.
        loginUtils.togglePageDomHandle(true);
        // Update the room ID on the page.
        loginUtils.updateRoomIDDomHandle(zegoConfig.roomID);

        // Mount the activated SuperboardSubView. (method in the room)
        attachActiveView();
    } catch (error) {
        console.error(error);
    }
});

// Bind the leave room event.
$('#logout-btn').click(logoutRoom);