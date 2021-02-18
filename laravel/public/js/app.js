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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./public/scss/application.scss":
/*!**************************************!*\
  !*** ./public/scss/application.scss ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/js/app.js":
/*!************************************!*\
  !*** ./resources/assets/js/app.js ***!
  \************************************/
/*! no static exports found */
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

/***/ "./resources/assets/js/auto_scroll.js":
/*!********************************************!*\
  !*** ./resources/assets/js/auto_scroll.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  window.scrollTo(0, document.body.scrollHeight);
});

/***/ }),

/***/ "./resources/assets/js/fixed.js":
/*!**************************************!*\
  !*** ./resources/assets/js/fixed.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $("#app").css("padding-top", $("#fixed-wrap").outerHeight());
});

/***/ }),

/***/ "./resources/assets/js/flash.js":
/*!**************************************!*\
  !*** ./resources/assets/js/flash.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $(".flash_message").slideDown(500);
  setTimeout(function () {
    $(".flash_message").slideUp(500);
  }, 2000);
});

/***/ }),

/***/ "./resources/assets/js/like.js":
/*!*************************************!*\
  !*** ./resources/assets/js/like.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var likes_count_link_html = function likes_count_link_html(post_id, like_count) {
  var html = "\n  <hr>\n    <a href=\"".concat(location.origin, "/posts/").concat(post_id, "/like_index\" class=\"text-center\">\n      <p><strong>").concat(like_count, "</strong>\u540D\u306B\u300C\u3044\u3044\u306D\u300D\u3055\u308C\u3066\u3044\u307E\u3059\u3002</p>\n    </a>\n  <hr>\n  ");
  return html;
};

$(function () {
  $(".heart").on('click', function () {
    var post_id = $(this).data("post-id");
    var like_element = $(this);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "put",
      url: "/posts/".concat(post_id, "/like"),
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

      if (data['count'] != 0) {
        $("#likes-count-link").html(likes_count_link_html(post_id, data['count']));
      } else {
        $("#likes-count-link").html('');
      }
    }).fail(function (data, xhr, err) {
      alert("エラーが発生しました。");
    });
  });
});

/***/ }),

/***/ "./resources/assets/js/subject_complement.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/subject_complement.js ***!
  \***************************************************/
/*! no static exports found */
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
    var keyword = $("#subject-title").val(); // 何も入力されていない場合

    if (!keyword) {
      // 自動補完を削除
      $("#subject-complement-list").remove();
      return false;
    }

    $.ajax({
      type: "get",
      url: "/subjects/complement",
      data: {
        "keyword": keyword
      },
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
  }); // 科目名のinputフォームから外れた時

  $("#subject-title").on("blur", function () {
    // 自動補完リストを削除
    $("#subject-complement-list").remove();
  });
});

/***/ }),

/***/ "./resources/assets/js/user_image_preview.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/user_image_preview.js ***!
  \***************************************************/
/*! no static exports found */
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

/***/ 0:
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/assets/js/app.js ./resources/assets/js/user_image_preview.js ./resources/assets/js/fixed.js ./resources/assets/js/subject_complement.js ./resources/assets/js/like.js ./resources/assets/js/flash.js ./resources/assets/js/auto_scroll.js ./public/scss/application.scss ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/app.js */"./resources/assets/js/app.js");
__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/user_image_preview.js */"./resources/assets/js/user_image_preview.js");
__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/fixed.js */"./resources/assets/js/fixed.js");
__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/subject_complement.js */"./resources/assets/js/subject_complement.js");
__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/like.js */"./resources/assets/js/like.js");
__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/flash.js */"./resources/assets/js/flash.js");
__webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/resources/assets/js/auto_scroll.js */"./resources/assets/js/auto_scroll.js");
module.exports = __webpack_require__(/*! /Users/MoritaKenta/projects/effornal/laravel/public/scss/application.scss */"./public/scss/application.scss");


/***/ })

/******/ });