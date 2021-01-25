/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
__webpack_require__(2);
__webpack_require__(3);
__webpack_require__(4);
module.exports = __webpack_require__(5);


/***/ }),
/* 1 */
/***/ (function(module, exports) {


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

/***/ }),
/* 2 */
/***/ (function(module, exports) {

$(function () {
  if (document.URL.match(/users\/edit/)) {
    //画像変更時、プロフィールの画像も即時に変更
    $("#input-user-image").on("change", function (e) {
      var blob = window.URL.createObjectURL(e.target.files[0]);
      $("#user-image").attr("src", blob);
    });
  }
});

/***/ }),
/* 3 */
/***/ (function(module, exports) {

$(function () {
  $("#app").css("padding-top", 77);
  if (document.URL.match(/users\/\d+/)) {
    $("#post-list").css("padding-top", 189);
  }
});

/***/ }),
/* 4 */
/***/ (function(module, exports) {

var set_function = function set_function() {

  // 自動補完リストを選択したら
  $(".subject-complement-item").on("mousedown touchstart", function () {
    // inputフォームに値を入れ込む
    $("#subject-title").val($(this).text());
  });
};

$(function () {

  // 科目名のフォームに何かしら入力されたら
  $("#subject-title").on("keyup", function () {
    var keyword = $("#subject-title").val();

    // 何も入力されていない場合
    if (!keyword) {
      // 自動補完を削除
      $("#subject-complement-list").remove();
      return false;
    }

    $.ajax({
      type: "get",
      url: "/subjects/complement",
      data: { "keyword": keyword },
      dataType: "json"
    }).done(function (data) {
      // 自動補完を削除
      $("#subject-complement-list").remove();
      var subject_complement_list = $("<ul>").attr("id", "subject-complement-list");
      data.forEach(function (subject) {
        var subject_complement_item = $("<li>").addClass("subject-complement-item").text(subject.name);
        subject_complement_list.append(subject_complement_item);
      });
      $("#subject-input").append(subject_complement_list);
      set_function();
    }).fail(function () {
      alert("エラーが発生しました。");
    });
  });

  // 科目名のinputフォームから外れた時
  $("#subject-title").on("blur", function () {
    // 自動補完リストを削除
    $("#subject-complement-list").remove();
  });
});

/***/ }),
/* 5 */
/***/ (function(module, exports) {

$(function () {
  $(".heart").on('click', function () {
    var post_id = $(this).data("post-id");
    var like_element = $(this);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "put",
      url: "/posts/" + post_id + "/like",
      // data: { "post_id": post_id },
      dataType: "json"
    }).done(function (data) {

      // ログインしていない場合
      if (data.length <= 0) {
        return alert("いいね機能はログイン中にのみ利用できます。");
      }

      if (data['liked']) {
        like_element.addClass('liked');
      } else {
        like_element.removeClass('liked');
      }
      like_element.siblings('.like-count').text(data['count']);
    }).fail(function (data, xhr, err) {
      alert("エラーが発生しました。");
    });
  });
});

/***/ })
/******/ ]);