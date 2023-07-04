/*
 * @Author: ZegoDev
 * @Date: 2021-07-28 14:58:21
 * @LastEditTime: 2021-09-10 11:05:26
 * @LastEditors: Please set LastEditors
 * @Description: initialization related
 * @FilePath: /superboard/js/login/init.js
 */

// Environment-related configurations
var zegoEnvConfig = {
    env: loginUtils.getEnv(), // 1 mainland 2 oversea
    superBoardEnv: 'prod',
    appID: 1863323429,
    serverProd: '2276975a83c82c6cc6c78a56724a2197',
    overseaAppID: 0,
    overseaServerProd: '',
    token: '04AAAAAGSl1E0AEHh0aG9uYml6bzdka3YxY2gAoPeNsH9/jzQJeS3+Q2gTrpKIDotIH+C7s/0vlWz5aU2hFW/NnpfzZ4ohQZirDOvjWKRLYm1uMyDO5zcAN+WXXGv6g7AsxT/czANXaW6KhiVyH1HzMIwa6p5aR5et7l+l6m3uSKtmA6bJE0kZABiPFtuq8XIZVVUyUfQgwZ+NCV9CEJ3KAl//oYbQT2U3nQQGfVnaJBqrpwSlgqycLxcy+3Q='
};

// SDK feature configurations
var zegoFeatureConfig = {
    fontFamily: 'system', // Superboard SDK fontFamily
    disableH5ImageDrag: 'false', // Whether to disable drag and drop for images true: disabled false: normal
    thumbnailMode: '1', // Thumbnail sharpness 1: normal 2: SD 3: HD
    pptStepMode: '1', // PPT page mode 1: normal 2: do not jump
};

// Other SDK configurations
var zegoOtherConfig = {
    roomID: loginUtils.getRoomID(),
    userID: loginUtils.getUserID(),
    userName: '',
};

// Configuration set
var zegoConfig = {
    ...zegoEnvConfig,
    ...zegoFeatureConfig,
    ...zegoOtherConfig
};

var parentDomID = 'main-whiteboard'; // SupboardView Mounted parent container
var zegoEngine; // Express SDK instance
var zegoSuperBoard; // SuperBoard SDK instance

/**
 * @description: Verify the configured appID and tokenUrl.
 */
function checkConfig() {
    if (!zegoConfig.appID || !zegoConfig.token) {
        alert('appID and token cannot be empty');
        return false;
    }
    return true;
}

/**
 * @description: Initialize the SDK based on the configuration.
 * @return {String} token
 */
async function initZegoSDK() {
    var appID = zegoConfig.appID;
    var userID = zegoConfig.userID;
    var server = zegoConfig.serverProd;

    if (zegoConfig.env === '2') {
        // Environment outside China
        appID = zegoConfig.overseaAppID;
        server = zegoConfig.overseaServerProd;
    }

    console.warn('====superboard demo appid:', zegoConfig.superBoardEnv, appID, userID)

    zegoEngine = new ZegoExpressEngine(appID, server);

    // Obtain the token.
    var token = zegoEnvConfig.token

    // Initialize the combination layer SDK.
    zegoSuperBoard = ZegoSuperBoardManager.getInstance();
    zegoSuperBoard.init(zegoEngine, {
        parentDomID,
        userID,
        appID,
        token
    });
    document.title = `Superboard demo:${zegoSuperBoard.getSDKVersion()}`;
    initExpressSDKConfig();
    initSuperBoardSDKConfig();

    return token;
}

/**
 * @description: Initialize the Express SDK based on the configuration.
 */
function initExpressSDKConfig() {
    // Set the log level.
    zegoEngine.setLogConfig({
        logLevel: 'disable'
    });
    // Disable debug.
    zegoEngine.setDebugVerbose(false);
}

/**
 * @description: Initialize the SuperBoard SDK based on the configuration initialization.
 */
function initSuperBoardSDKConfig() {
    // Set the font.
    if (zegoConfig.fontFamily === 'ZgFont') {
        document.getElementById(parentDomID).style.fontFamily = zegoConfig.fontFamily;
    }

    // Set whether images in the animated PPT can be dragged.
    zegoSuperBoard.setCustomizedConfig('disableH5ImageDrag', zegoConfig.disableH5ImageDrag);

    // Set the animated PPT step page turning mode.
    zegoSuperBoard.setCustomizedConfig('pptStepMode', zegoConfig.pptStepMode);
    // Set the thumbnail definition mode.
    zegoSuperBoard.setCustomizedConfig('thumbnailMode', zegoConfig.thumbnailMode);

    zegoSuperBoard.enableCustomCursor(true);
}

/**
 * @description: Initialize the SDK and log in to the room based on the configuration.
 */
async function init() {
    try {
        // Verify parameters.
        if (!checkConfig()) return;
        // Obtain login information.
        var loginInfo = JSON.parse(sessionStorage.getItem('loginInfo'));
        // Determine whether the user has logged in.
        if (loginInfo && loginInfo.roomID) {
            // Logged in
            // Update local zegoConfig.
            Object.assign(zegoConfig, loginInfo);

            // Initialize the SDK.
            var token = await initZegoSDK();
            // Log in to the room.
            const login_res = await loginRoom(token);

            console.warn('=====demo login', login_res)

            // Display the room page.
            loginUtils.togglePageDomHandle(true);

            // Mount the activated SuperboardSubView. (method in the room)
            attachActiveView();

        } else {
            // Not logged in
            // Display the login page.
            loginUtils.togglePageDomHandle(false);
        }
        // Update the room ID on the page.
        loginUtils.updateRoomIDDomHandle(zegoConfig.roomID);
        // Update the selection for the access environment on the page.
        loginUtils.updateEnvDomHandle(zegoConfig.env);
    } catch (error) {
        console.error(error);
    }
}

// By default, the user initializes the SDK and logs in to the room based on configurations.
init();