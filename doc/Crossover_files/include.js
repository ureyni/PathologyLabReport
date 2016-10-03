// jshint ignore: start
// production mode

(function (window, document, elementType, scriptSource, trackingFunction, a,
           m) {
  window['GoogleAnalyticsObject'] = trackingFunction;
  window[trackingFunction] = window[trackingFunction] || function () {
      (window[trackingFunction].q =
        window[trackingFunction].q || []).push(arguments)
    };
  window[trackingFunction].l = 1 * new Date();
  a = document.createElement(elementType), m =
    document.getElementsByTagName(elementType)[0];
  a.async = 1;
  a.src = scriptSource;
  m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-57523840-5', 'auto');

var facebookPixels = ['1015922038450422', '1502036423437551', '474021666132713'],
    fpl = facebookPixels.length;

window.trackingCodes = {
  googleAdwords: {
    google_conversion_id: 944862710,
    google_conversion_language: 'en',
    google_conversion_format: '3',
    google_conversion_color: 'ffffff',
    google_conversion_label: 'Ien-CKHVumAQ9uvFwgM',
    google_remarketing_only: false
  }, facebook: {
    id: facebookPixels
  }
};

!function (f, b, e, v, n, t, s) {
  if (f.fbq) {
    return;
  }
  n = f.fbq = function () {
    n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
  };
  if (!f._fbq) {
    f._fbq = n;
  }
  n.push = n;
  n.loaded = !0;
  n.version = '2.0';
  n.queue = [];
  t = b.createElement(e);
  t.async = !0;
  t.src = v;
  s = b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t, s)
}(window, document, 'script', '//connect.facebook.net/en_US/fbevents.js');

while(fpl--){
  fbq('init', facebookPixels[fpl]);
}

window.configuration = {
  raven: {
    enabled: true,
    id: 'https://d17f8d4a66c14ac28bc99ec3f4992180@app.getsentry.com/60089'
  }
};

