import { ZegoBroadcastMessageInfo } from "zego-express-engine-webrtm/sdk/code/zh/ZegoExpressEntity.d";
import { ZegoSuperBoardView } from "zego-superboard-web";
import { ZegoCloudRTCCore } from "../modules";
import { ZegoCloudUser, ZegoCloudUserList } from "../modules/tools/UserListManager";
export interface ZegoCloudRemoteMedia {
    media: MediaStream | undefined;
    fromUser: ZegoUser;
    micStatus: "OPEN" | "MUTE";
    cameraStatus: "OPEN" | "MUTE";
    state: "NO_PLAY" | "PLAY_REQUESTING" | "PLAYING";
    streamID: string;
    urlsHttpsFLV?: string;
    urlsHttpsHLS?: string;
    hasAudio?: boolean;
    hasVideo?: boolean;
}
export declare enum LiveRole {
    Host = "Host",
    Cohost = "Cohost",
    Audience = "Audience"
}
export declare enum ScenarioModel {
    OneONoneCall = "OneONoneCall",
    GroupCall = "GroupCall",
    VideoConference = "VideoConference",
    LiveStreaming = "LiveStreaming"
}
export declare enum VideoResolution {
    _180P = "180p",
    _360P = "360p",
    _480P = "480p",
    _720P = "720p"
}
export interface ScenarioConfig {
    [ScenarioModel.LiveStreaming]: {
        role: LiveRole;
        liveStreamingMode: LiveStreamingMode;
    };
    [ScenarioModel.OneONoneCall]: {
        role: LiveRole;
    };
    [ScenarioModel.GroupCall]: {
        role: LiveRole;
    };
    [ScenarioModel.VideoConference]: {
        role: LiveRole;
    };
}
export declare enum LiveStreamingMode {
    /**
     * @Deprecated  StanderLive will be removed, please use LiveStreaming instead
     */
    StanderLive = "LiveStreaming",
    /**
     * @Deprecated  PremiumLive will be removed, please use InteractiveLiveStreaming instead
     */
    PremiumLive = "InteractiveLiveStreaming",
    LiveStreaming = "LiveStreaming",
    InteractiveLiveStreaming = "InteractiveLiveStreaming",
    RealTimeLive = "RealTimeLive"
}
export interface ZegoCloudRoomConfig {
    container?: HTMLElement | undefined | null;
    preJoinViewConfig?: {
        title?: string;
        invitationLink?: string;
    };
    showPreJoinView?: boolean;
    turnOnMicrophoneWhenJoining?: boolean;
    turnOnCameraWhenJoining?: boolean;
    showMyCameraToggleButton?: boolean;
    showMyMicrophoneToggleButton?: boolean;
    showAudioVideoSettingsButton?: boolean;
    showTextChat?: boolean;
    showUserList?: boolean;
    lowerLeftNotification?: {
        showUserJoinAndLeave?: boolean;
        showTextChat?: boolean;
    };
    branding?: {
        logoURL?: string;
    };
    showLeavingView?: boolean;
    maxUsers?: number;
    layout?: "Sidebar" | "Grid" | "Auto";
    showNonVideoUser?: boolean;
    showOnlyAudioUser?: boolean;
    useFrontFacingCamera?: boolean;
    onJoinRoom?: () => void;
    onLeaveRoom?: () => void;
    onUserJoin?: (user: ZegoUser[]) => void;
    onUserLeave?: (user: ZegoUser[]) => void;
    sharedLinks?: {
        name?: string;
        url?: string;
    }[];
    showScreenSharingButton?: boolean;
    scenario?: {
        mode?: ScenarioModel;
        config?: ScenarioConfig[ScenarioModel];
    };
    showLayoutButton?: boolean;
    showPinButton?: boolean;
    onUserAvatarSetter?: (user: ZegoUser[]) => void;
    videoResolutionList?: VideoResolution[];
    videoResolutionDefault?: VideoResolution;
    onLiveStart?: (user: ZegoUser) => void;
    onLiveEnd?: (user: ZegoUser) => void;
    /**
     * @deprecated facingMode will be removed
     * */
    facingMode?: "user" | "environment";
    /**
     * @deprecated joinRoomCallback will be removed
     * */
    joinRoomCallback?: () => void;
    /**
     * @deprecated leaveRoomCallback will be removed
     * */
    leaveRoomCallback?: () => void;
    /**
     * @deprecated userUpdateCallback will be removed
     * */
    userUpdateCallback?: (updateType: "DELETE" | "ADD", userList: ZegoUser[]) => void;
    /**
     * @deprecated roomTimerDisplayed will be removed
     * */
    roomTimerDisplayed?: boolean;
    whiteboardConfig?: {
        showAddImageButton?: boolean;
        showCreateAndCloseButton?: boolean;
    };
    autoLeaveRoomWhenOnlySelfInRoom?: boolean;
}
export interface ZegoBrowserCheckProp {
    core: ZegoCloudRTCCore;
    joinRoom?: () => void;
    leaveRoom?: () => void;
    returnHome?: () => void;
}
export interface ZegoNotification {
    type: "USER" | "MSG";
    content: string;
    userName: undefined | string;
    messageID: number;
}
export declare type ZegoBroadcastMessageInfo2 = ZegoBroadcastMessageInfo & {
    status: "SENDING" | "SENDED" | "FAILED";
};
export interface ZegoSettingsProps {
    core: ZegoCloudRTCCore;
    theme?: string;
    initDevices: {
        mic: string | undefined;
        cam: string | undefined;
        speaker: string | undefined;
        videoResolve: string | undefined;
        showNonVideoUser: boolean | undefined;
    };
    closeCallBack?: () => void;
    onMicChange: (deviceID: string) => void;
    onCameraChange: (deviceID: string) => void;
    onSpeakerChange: (deviceID: string) => void;
    onVideoResolutionChange: (level: string) => void;
    onShowNonVideoChange: (selected: boolean) => void;
}
export interface ZegoGridLayoutProps {
    userList: ZegoCloudUserList;
    videoShowNumber: number;
    gridRowNumber?: number;
    selfInfo?: {
        userID: string;
    };
    handleSetPin?: Function;
    soundLevel?: SoundLevelMap;
}
export interface ZegoSidebarLayoutProps {
    handleSetPin?: Function;
    userList: ZegoCloudUserList;
    videoShowNumber: number;
    selfInfo: {
        userID: string;
    };
    soundLevel?: SoundLevelMap;
}
export interface ZegoScreenSharingLayoutProps {
    handleSetPin?: Function;
    userList: ZegoCloudUserList;
    videoShowNumber: number;
    selfInfo: {
        userID: string;
    };
    roomID?: String;
    screenSharingUser: ZegoCloudUser;
    soundLevel?: SoundLevelMap;
    handleFullScreen?: (fullScreen: boolean) => void;
}
export interface ZegoWhiteboardSharingLayoutProps {
    handleSetPin?: Function;
    userList: ZegoCloudUserList;
    videoShowNumber: number;
    selfInfo: {
        userID: string;
    };
    roomID?: String;
    onShow: (el: HTMLDivElement) => void;
    onResize: (el: HTMLDivElement) => void;
    onclose: () => void;
    onToolChange: (type: number, fontSize?: number, color?: string) => void;
    onFontChange: (font?: "BOLD" | "ITALIC" | "NO_BOLD" | "NO_ITALIC", fontSize?: number, color?: string) => void;
    soundLevel?: SoundLevelMap;
    handleFullScreen?: (fullScreen: boolean) => void;
    onImageAdd?: () => void;
    zegoSuperBoardView?: ZegoSuperBoardView | null;
}
export interface SoundLevelMap {
    [userID: string]: {
        [streamID: string]: number;
    };
}
export declare enum ZegoStreamType {
    main = 0,
    media = 1,
    screensharing = 2
}
export interface ZegoUser {
    userID: string;
    userName?: string;
    setUserAvatar?: (avatar: string) => void;
}
export declare enum CoreError {
    notSupportCDNLive = 10001,
    notSupportStandardLive = 10002
}
export declare enum ZegoInvitationType {
    VoiceCall = 0,
    VideoCall = 1
}
export interface ZegoCallInvitationConfig {
    enableCustomCallInvitationWaitingPage?: boolean;
    enableCustomCallInvitationDialog?: boolean;
    enableNotifyWhenAppRunningInBackgroundOrQuit?: boolean;
    ringtoneConfig?: {
        incomingCallUrl?: string;
        outgoingCallUrl?: string;
    };
    onWaitingPageWhenSending?: (callType: ZegoInvitationType, callees: ZegoUser[], cancel: CancelCallInvitationFunc) => void;
    onConfirmDialogWhenReceiving?: (callType: ZegoInvitationType, caller: ZegoUser, refuse: RefuseCallInvitationFunc, accept: AcceptCallInvitationFunc, data: string) => void;
    onSetRoomConfigBeforeJoining?: (callType: ZegoInvitationType) => ZegoCloudRoomConfig;
    onCallInvitationEnded?: (reason: CallInvitationEndReason, data: string) => void;
    onIncomingCallReceived?: (callID: string, caller: ZegoUser, callType: ZegoInvitationType, callees: ZegoUser[]) => void;
    onIncomingCallCanceled?: (callID: string, caller: ZegoUser) => void;
    onOutgoingCallAccepted?: (callID: string, callee: ZegoUser) => void;
    onOutgoingCallRejected?: (callID: string, callee: ZegoUser) => void;
    onOutgoingCallDeclined?: (callID: string, callee: ZegoUser) => void;
    onIncomingCallTimeout?: (callID: string, caller: ZegoUser) => void;
    onOutgoingCallTimeout?: (callID: string, callees: ZegoUser[]) => void;
}
export type CancelCallInvitationFunc = (data?: string) => void;
export type AcceptCallInvitationFunc = (data?: string) => void;
export type RefuseCallInvitationFunc = (data?: string) => void;
export interface CallInvitationInfo {
    callID: string;
    roomID: string;
    inviter: ZegoUser;
    invitees: ZegoUser[];
    /** 已接受邀请的用户 */
    acceptedInvitees: ZegoUser[];
    type: ZegoInvitationType;
    isGroupCall: boolean;
}
export declare enum CallInvitationEndReason {
    Declined = "Declined",
    Timeout = "Timeout",
    Canceled = "Canceled",
    Busy = "Busy",
    LeaveRoom = "LeaveRoom"
}
export interface ZegoSignalingPluginNotificationConfig {
    resourcesID?: string;
    title?: string;
    message?: string;
}
