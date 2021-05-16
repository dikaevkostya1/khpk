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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/request/request.js":
/*!*****************************************!*\
  !*** ./resources/js/request/request.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var form = $('#request form');
  form.on('submit', function (e) {
    e.preventDefault();
    $('#loader').fadeIn(100);
    $('#loader').append('<div class="ajax_loader"></div>');
    $('#loader').children('.ajax_loader').fadeIn(200);
    var data = new FormData(this);
    $('#request form .select').each(function (key, element) {
      data.append($(this).attr('id'), $(this).data('value'));
    });
    data.append('speciality_id', JSON.stringify($('#request form .specialties').data('value')));
    $.ajax({
      type: "POST",
      url: '/ajax/request/push',
      enctype: 'multipart/form-data',
      data: data,
      processData: false,
      contentType: false,
      success: function success(data) {
        if (data.redirect == true) window.location.replace(data.redirect_url);else {
          $('body').html(data.view);
          $('#loader').fadeOut(100);
        }
      },
      error: function error(response) {
        var data = response.responseJSON.errors;
        $('#loader').children('.ajax_loader').fadeOut(200);
        setTimeout(function () {
          $('#loader').children('.ajax_loader').remove();
        }, 500);
        show_message(data);
      }
    });
    return false;
  });

  timer_click = function timer_click(url) {
    $.get(url).done(function () {
      $('#request form .timer_button').css('display', 'none');
      $('#request form .timer_block').fadeIn(200);

      var seconds = 60,
          _int = setInterval(function () {
        if (seconds > 0) {
          seconds--;
          $('#request form .timer_block .time').text(seconds);
        } else {
          clearInterval(_int);
          $('#request form .timer_block').css('display', 'none');
          $('#request form .timer_button').fadeIn(200);
        }
      }, 1000);
    });
  };
});

/***/ }),

/***/ 1:
/*!***********************************************!*\
  !*** multi ./resources/js/request/request.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/kostya/sites/khpk/resources/js/request/request.js */"./resources/js/request/request.js");


/***/ })

/******/ });