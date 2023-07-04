var i18nLanguage = 'en';

var webLanguage = ['cn', 'en'];

function getWebLanguage() {
  if (sessionStorage.getItem("userLanguage")) {
    i18nLanguage = sessionStorage.getItem("userLanguage");
    console.log("language  is:" + i18nLanguage);
  }
  console.log("language  is:" + i18nLanguage);
}



var execI18n = function () {
  getWebLanguage();

  jQuery.i18n.properties({
    name: "i18n",
    path: "i18n/",
    mode: 'map',
    language: i18nLanguage,
    cache: false,
    encoding: 'UTF-8',
    callback: function () {
      $('[data-locale]').each(function () {
        console.warn($(this).data('locale'), $.i18n.prop($(this).data('locale')))
        console.warn('html', $(this).html())
        $(this).html($.i18n.prop($(this).data('locale')))
      })
    }
  });
}

execI18n()