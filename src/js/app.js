import "lazysizes";
import "alpinejs";
import Turbolinks from "turbolinks";

Turbolinks.start();

// base namespace (use unique name for each project)
var base = base || {};

// client related functions
base.client = function() {
  var tabletBreakpoint = 700;
  var desktopBreakpoint = 1100;
  var deviceType = "mobile";

  var isMobile = function() {
    return deviceType === "mobile";
  };

  var isTablet = function() {
    return deviceType === "tablet";
  };

  var isDesktop = function() {
    return deviceType === "desktop";
  };

  var win = {
    height: 0,
    width: 0,
    widthWithoutScrollbar: 0,
    scrollbarWidth: 0
  };

  var html;
  var body;

  // removes nojs class from header
  document.documentElement.className = "js";

  document.addEventListener(
    "DOMContentLoaded",
    function() {
      init();
      deviceTypeDetection();
      windowResizeEvent();
      deviceOrientationChangeEvent();
    },
    false
  );

  var init = function() {
    html = document.querySelector("html");
    body = document.querySelector("body");
  };

  var deviceTypeDetection = function() {
    win.width = window.innerWidth;
    win.height = window.innerHeight;
    win.scrollbarWidth =
      window.innerWidth - document.documentElement.clientWidth;
    win.widthWithoutScrollbar = window.innerWidth - win.scrollbarWidth;

    if (win.width < tabletBreakpoint) {
      deviceType = "mobile";
      body.classList.remove("tablet", "desktop");
    } else if (win.width >= tabletBreakpoint && win.width < desktopBreakpoint) {
      deviceType = "tablet";
      body.classList.remove("mobile", "desktop");
    } else if (win.width >= desktopBreakpoint) {
      deviceType = "desktop";
      body.classList.remove("tablet", "desktop");
    }
    body.classList.add(deviceType);

    if (win.width > win.height) {
      body.classList.add("landscape");
      body.classList.remove("portrait");
    } else {
      body.classList.add("portrait");
      body.classList.remove("landscape");
    }
  };

  var windowResizeEvent = function() {
    window.onresize = function(e) {
      var prevDeviceType = "";
      if (body.classList.contains("mobile")) {
        prevDeviceType = "mobile";
      } else if (body.classList.contains("tablet")) {
        prevDeviceType = "tablet";
      } else if (body.classList.contains("desktop")) {
        prevDeviceType = "desktop";
      }

      deviceTypeDetection();
      // reload page only if the resize causes switch betweeen mobile and desktop
      if (deviceType !== prevDeviceType) {
        deviceSizeSwitchHappened();
      }
      win.width = window.innerWidth;
      win.height = window.innerHeight;
      try {
        windowResized();
      } catch (e) {}
    };
  };

  var deviceOrientationChangeEvent = function() {
    window.addEventListener(
      "orientationchange",
      function() {
        location.reload(false);
      },
      false
    );
  };

  // window/layout was switched between mobile tablet or desktop
  var deviceSizeSwitchHappened = function() {
    location.reload(false);
  };

  var setFullscreenMode = function(state) {
    if (state) {
      html.style.overflowY = "hidden";
      html.style.paddingRight = win.scrollbarWidth + "px";
    } else {
      html.style.overflowY = "scroll";
      html.style.paddingRight = 0;
    }
  };

  var windowResized = function() {
    // functions that should be executed after resize
  };

  return {
    isMobile: isMobile,
    isTablet: isTablet,
    isDesktop: isDesktop,
    win: win,
    setFullscreenMode: setFullscreenMode
  };
};

base.client();
