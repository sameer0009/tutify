# ZegoSuperBoard SDK Demo

## Project guideline

### Fill in required parameters

In the `js/login/init.js` file, fill in the required AppID and ServerSecret parameters when logging in to a room.

### Run the project

In the project directory, open the `index.html` page, and enter the room ID and username to join a room.

## Project structure
```
superboard
├─ README.md #  The README file of the project
├─ fileList.json # ZEGOCLOUD preset file list
├─ img # The iamges being used in the project
│  ├─ custom-icon-active.png
│  ├─ custom-icon.png
│  ├─ login-bg.png
│  └─ logo.png
├─ index.html # Entry file
├─ js # All the JavaScript that is not a third-party UI used by the project
│  ├─ login # Fetures related to log and initialization
│  │  ├─ init.js # Initialization related features
│  │  ├─ login.js # Login related features
│  │  └─ utils.js # DOM updating methods, tool related methods
│  └─ room # Room module, whiteboard related features
│     ├─ addImage.js # Add custom graphics and insert pictures
│     ├─ cacheFile.js # File preloading
│     ├─ flipToPage.js # Paging feature
│     ├─ other.js # Clear, undo, redo, save snapshot, clear current page, clear selected, set render delay
│     ├─ reloadView.js # Reload the whiteboard View
│     ├─ setBackgroundImage.js # Set up the background image 
│     ├─ setOperationMode.js # Operation modes
│     ├─ setOther.js # Brush, brush thickness, brush color, text size, text bold, text italic
│     ├─ setScaleFactor.js # Zooming feature
│     ├─ setToolType.js # Setting the Whiteboard
│     ├─ uploadFile.js # Upload static and dynamic files
│     ├─ uploadH5File.js # Upload to H5
│     ├─ utils.js # Room module, methods to update DOM, and methods related to tool
│     └─ whiteboard.js # Create, destroy, switch, query whiteboard list and other related functions
├─ lib # CSS, JavaScript files, and built-in third-party font files required by third-party UI libraries
├─ main.css # All CSS styles for the non-third-party UI used by the project
└─ sdk # ZEGOCLOUD SDKs used by the project
   ├─ ZegoSuperBoardWeb-2.0.0.js # ZEGOCLOUD Super Board SDK 
   └─ ZegoExpressWebRTC-2.9.1.js # ZEGOCLOUD Voice and Video SDK

```

## The third-party UI libraries
The functional modules in the project are written in native JavaScript, and the UI library of the third party is used at the same time. Annotations have been added where the UI library is used in the code, which is only for reference. Developers can process according to the framework and UI library chosen by their own projects.

The official documents of the UI library used by the project are as follows:
- Bootstrap: https://v3.bootcss.com
- Layui: https://www.layui.com/doc/
