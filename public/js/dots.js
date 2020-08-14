/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/Exercise/DotsExercise.ts":
/*!**************************************!*\
  !*** ./src/Exercise/DotsExercise.ts ***!
  \**************************************/
/*! namespace exports */
/*! export DotsExercise [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "DotsExercise": () => /* binding */ DotsExercise
/* harmony export */ });
function distance(dot) {
    return Math.sqrt(dot.x * dot.x + dot.y * dot.y);
}
var DotsExercise = /** @class */ (function () {
    function DotsExercise(totalDots, canvas) {
        this.totalDots = totalDots;
        this.canvas = canvas;
        this.dots = [];
        for (var i = 0; i < this.totalDots; i++) {
            this.dots.push({
                x: (Math.random() * 200 | 0) - 100,
                y: (Math.random() * 200 | 0) - 100
            });
        }
        this.setupCanvas();
        this.draw();
    }
    DotsExercise.prototype.draw = function () {
        var context = this.canvas.getContext('2d');
        context.beginPath();
        context.moveTo(10, 110);
        context.lineTo(210, 110);
        context.moveTo(110, 10);
        context.lineTo(110, 210);
        context.stroke();
        context.beginPath();
        context.moveTo(210, 110);
        context.arc(110, 110, 100, 0, 2 * Math.PI);
        context.stroke();
        context.beginPath();
        context.rect(10, 10, 200, 200);
        context.stroke();
        for (var _i = 0, _a = this.dots; _i < _a.length; _i++) {
            var dot = _a[_i];
            context.beginPath();
            if (distance(dot) > 100) {
                context.strokeStyle = 'rgba(194, 24, 7, 0.25)';
                context.fillStyle = 'rgba(194, 24, 7, 0.25)';
            }
            else {
                context.strokeStyle = 'rgba(12, 56, 166, 0.25)';
                context.fillStyle = 'rgba(12, 56, 166, 0.25)';
            }
            context.arc(dot.x + 110, dot.y + 110, 1, 0, 2 * Math.PI);
            context.stroke();
            context.fill();
        }
    };
    DotsExercise.prototype.setupCanvas = function () {
        var dpr = window.devicePixelRatio;
        var rect = this.canvas.getBoundingClientRect();
        this.canvas.width = rect.width * dpr;
        this.canvas.height = rect.height * dpr;
        var ctx = this.canvas.getContext('2d');
        ctx.scale(dpr, dpr);
    };
    return DotsExercise;
}());



/***/ }),

/***/ "./src/index.ts":
/*!**********************!*\
  !*** ./src/index.ts ***!
  \**********************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Exercise_DotsExercise__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Exercise/DotsExercise */ "./src/Exercise/DotsExercise.ts");

function distance(dot) {
    return Math.sqrt(dot.x * dot.x + dot.y * dot.y);
}
var exercise = new _Exercise_DotsExercise__WEBPACK_IMPORTED_MODULE_0__.DotsExercise(1000, document.querySelector('canvas'));
var inside = 0;
var outside = 0;
for (var _i = 0, _a = exercise.dots; _i < _a.length; _i++) {
    var dot = _a[_i];
    distance(dot) <= 100
        ? inside++
        : outside++;
}
console.info({
    inside: inside,
    outside: outside,
    ratio: inside / exercise.totalDots,
    fourRatio: 4 * (inside / exercise.totalDots),
    pi: Math.PI
});


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => Object.prototype.hasOwnProperty.call(obj, prop)
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	// startup
/******/ 	// Load entry module
/******/ 	__webpack_require__("./src/index.ts");
/******/ 	// This entry module used 'exports' so it can't be inlined
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zcmMtanMvLi9zcmMvRXhlcmNpc2UvRG90c0V4ZXJjaXNlLnRzIiwid2VicGFjazovL3NyYy1qcy8uL3NyYy9pbmRleC50cyIsIndlYnBhY2s6Ly9zcmMtanMvd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vc3JjLWpzL3dlYnBhY2svcnVudGltZS9kZWZpbmUgcHJvcGVydHkgZ2V0dGVycyIsIndlYnBhY2s6Ly9zcmMtanMvd2VicGFjay9ydW50aW1lL2hhc093blByb3BlcnR5IHNob3J0aGFuZCIsIndlYnBhY2s6Ly9zcmMtanMvd2VicGFjay9ydW50aW1lL21ha2UgbmFtZXNwYWNlIG9iamVjdCIsIndlYnBhY2s6Ly9zcmMtanMvd2VicGFjay9zdGFydHVwIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSx1QkFBdUIsb0JBQW9CO0FBQzNDO0FBQ0E7QUFDQTtBQUNBLGFBQWE7QUFDYjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLHdDQUF3QyxnQkFBZ0I7QUFDeEQ7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsQ0FBQztBQUN1Qjs7Ozs7Ozs7Ozs7Ozs7OztBQzFEK0I7QUFDdkQ7QUFDQTtBQUNBO0FBQ0EsbUJBQW1CLGdFQUFZO0FBQy9CO0FBQ0E7QUFDQSxvQ0FBb0MsZ0JBQWdCO0FBQ3BEO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxDQUFDOzs7Ozs7O1VDbkJEO1VBQ0E7O1VBRUE7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBOztVQUVBO1VBQ0E7O1VBRUE7VUFDQTtVQUNBOzs7OztXQ3JCQTtXQUNBO1dBQ0E7V0FDQTtXQUNBLHdDQUF3Qyx5Q0FBeUM7V0FDakY7V0FDQTtXQUNBLEU7Ozs7O1dDUEEsc0Y7Ozs7O1dDQUE7V0FDQTtXQUNBO1dBQ0Esc0RBQXNELGtCQUFrQjtXQUN4RTtXQUNBLCtDQUErQyxjQUFjO1dBQzdELEU7Ozs7VUNOQTtVQUNBO1VBQ0E7VUFDQSIsImZpbGUiOiJkb3RzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gZGlzdGFuY2UoZG90KSB7XHJcbiAgICByZXR1cm4gTWF0aC5zcXJ0KGRvdC54ICogZG90LnggKyBkb3QueSAqIGRvdC55KTtcclxufVxyXG52YXIgRG90c0V4ZXJjaXNlID0gLyoqIEBjbGFzcyAqLyAoZnVuY3Rpb24gKCkge1xyXG4gICAgZnVuY3Rpb24gRG90c0V4ZXJjaXNlKHRvdGFsRG90cywgY2FudmFzKSB7XHJcbiAgICAgICAgdGhpcy50b3RhbERvdHMgPSB0b3RhbERvdHM7XHJcbiAgICAgICAgdGhpcy5jYW52YXMgPSBjYW52YXM7XHJcbiAgICAgICAgdGhpcy5kb3RzID0gW107XHJcbiAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCB0aGlzLnRvdGFsRG90czsgaSsrKSB7XHJcbiAgICAgICAgICAgIHRoaXMuZG90cy5wdXNoKHtcclxuICAgICAgICAgICAgICAgIHg6IChNYXRoLnJhbmRvbSgpICogMjAwIHwgMCkgLSAxMDAsXHJcbiAgICAgICAgICAgICAgICB5OiAoTWF0aC5yYW5kb20oKSAqIDIwMCB8IDApIC0gMTAwXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgICAgICB0aGlzLnNldHVwQ2FudmFzKCk7XHJcbiAgICAgICAgdGhpcy5kcmF3KCk7XHJcbiAgICB9XHJcbiAgICBEb3RzRXhlcmNpc2UucHJvdG90eXBlLmRyYXcgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdmFyIGNvbnRleHQgPSB0aGlzLmNhbnZhcy5nZXRDb250ZXh0KCcyZCcpO1xyXG4gICAgICAgIGNvbnRleHQuYmVnaW5QYXRoKCk7XHJcbiAgICAgICAgY29udGV4dC5tb3ZlVG8oMTAsIDExMCk7XHJcbiAgICAgICAgY29udGV4dC5saW5lVG8oMjEwLCAxMTApO1xyXG4gICAgICAgIGNvbnRleHQubW92ZVRvKDExMCwgMTApO1xyXG4gICAgICAgIGNvbnRleHQubGluZVRvKDExMCwgMjEwKTtcclxuICAgICAgICBjb250ZXh0LnN0cm9rZSgpO1xyXG4gICAgICAgIGNvbnRleHQuYmVnaW5QYXRoKCk7XHJcbiAgICAgICAgY29udGV4dC5tb3ZlVG8oMjEwLCAxMTApO1xyXG4gICAgICAgIGNvbnRleHQuYXJjKDExMCwgMTEwLCAxMDAsIDAsIDIgKiBNYXRoLlBJKTtcclxuICAgICAgICBjb250ZXh0LnN0cm9rZSgpO1xyXG4gICAgICAgIGNvbnRleHQuYmVnaW5QYXRoKCk7XHJcbiAgICAgICAgY29udGV4dC5yZWN0KDEwLCAxMCwgMjAwLCAyMDApO1xyXG4gICAgICAgIGNvbnRleHQuc3Ryb2tlKCk7XHJcbiAgICAgICAgZm9yICh2YXIgX2kgPSAwLCBfYSA9IHRoaXMuZG90czsgX2kgPCBfYS5sZW5ndGg7IF9pKyspIHtcclxuICAgICAgICAgICAgdmFyIGRvdCA9IF9hW19pXTtcclxuICAgICAgICAgICAgY29udGV4dC5iZWdpblBhdGgoKTtcclxuICAgICAgICAgICAgaWYgKGRpc3RhbmNlKGRvdCkgPiAxMDApIHtcclxuICAgICAgICAgICAgICAgIGNvbnRleHQuc3Ryb2tlU3R5bGUgPSAncmdiYSgxOTQsIDI0LCA3LCAwLjI1KSc7XHJcbiAgICAgICAgICAgICAgICBjb250ZXh0LmZpbGxTdHlsZSA9ICdyZ2JhKDE5NCwgMjQsIDcsIDAuMjUpJztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBlbHNlIHtcclxuICAgICAgICAgICAgICAgIGNvbnRleHQuc3Ryb2tlU3R5bGUgPSAncmdiYSgxMiwgNTYsIDE2NiwgMC4yNSknO1xyXG4gICAgICAgICAgICAgICAgY29udGV4dC5maWxsU3R5bGUgPSAncmdiYSgxMiwgNTYsIDE2NiwgMC4yNSknO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIGNvbnRleHQuYXJjKGRvdC54ICsgMTEwLCBkb3QueSArIDExMCwgMSwgMCwgMiAqIE1hdGguUEkpO1xyXG4gICAgICAgICAgICBjb250ZXh0LnN0cm9rZSgpO1xyXG4gICAgICAgICAgICBjb250ZXh0LmZpbGwoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG4gICAgRG90c0V4ZXJjaXNlLnByb3RvdHlwZS5zZXR1cENhbnZhcyA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2YXIgZHByID0gd2luZG93LmRldmljZVBpeGVsUmF0aW87XHJcbiAgICAgICAgdmFyIHJlY3QgPSB0aGlzLmNhbnZhcy5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKTtcclxuICAgICAgICB0aGlzLmNhbnZhcy53aWR0aCA9IHJlY3Qud2lkdGggKiBkcHI7XHJcbiAgICAgICAgdGhpcy5jYW52YXMuaGVpZ2h0ID0gcmVjdC5oZWlnaHQgKiBkcHI7XHJcbiAgICAgICAgdmFyIGN0eCA9IHRoaXMuY2FudmFzLmdldENvbnRleHQoJzJkJyk7XHJcbiAgICAgICAgY3R4LnNjYWxlKGRwciwgZHByKTtcclxuICAgIH07XHJcbiAgICByZXR1cm4gRG90c0V4ZXJjaXNlO1xyXG59KCkpO1xyXG5leHBvcnQgeyBEb3RzRXhlcmNpc2UgfTtcclxuIiwiaW1wb3J0IHsgRG90c0V4ZXJjaXNlIH0gZnJvbSBcIi4vRXhlcmNpc2UvRG90c0V4ZXJjaXNlXCI7XHJcbmZ1bmN0aW9uIGRpc3RhbmNlKGRvdCkge1xyXG4gICAgcmV0dXJuIE1hdGguc3FydChkb3QueCAqIGRvdC54ICsgZG90LnkgKiBkb3QueSk7XHJcbn1cclxudmFyIGV4ZXJjaXNlID0gbmV3IERvdHNFeGVyY2lzZSgxMDAwLCBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdjYW52YXMnKSk7XHJcbnZhciBpbnNpZGUgPSAwO1xyXG52YXIgb3V0c2lkZSA9IDA7XHJcbmZvciAodmFyIF9pID0gMCwgX2EgPSBleGVyY2lzZS5kb3RzOyBfaSA8IF9hLmxlbmd0aDsgX2krKykge1xyXG4gICAgdmFyIGRvdCA9IF9hW19pXTtcclxuICAgIGRpc3RhbmNlKGRvdCkgPD0gMTAwXHJcbiAgICAgICAgPyBpbnNpZGUrK1xyXG4gICAgICAgIDogb3V0c2lkZSsrO1xyXG59XHJcbmNvbnNvbGUuaW5mbyh7XHJcbiAgICBpbnNpZGU6IGluc2lkZSxcclxuICAgIG91dHNpZGU6IG91dHNpZGUsXHJcbiAgICByYXRpbzogaW5zaWRlIC8gZXhlcmNpc2UudG90YWxEb3RzLFxyXG4gICAgZm91clJhdGlvOiA0ICogKGluc2lkZSAvIGV4ZXJjaXNlLnRvdGFsRG90cyksXHJcbiAgICBwaTogTWF0aC5QSVxyXG59KTtcclxuIiwiLy8gVGhlIG1vZHVsZSBjYWNoZVxudmFyIF9fd2VicGFja19tb2R1bGVfY2FjaGVfXyA9IHt9O1xuXG4vLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcblx0aWYoX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXSkge1xuXHRcdHJldHVybiBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdLmV4cG9ydHM7XG5cdH1cblx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcblx0dmFyIG1vZHVsZSA9IF9fd2VicGFja19tb2R1bGVfY2FjaGVfX1ttb2R1bGVJZF0gPSB7XG5cdFx0Ly8gbm8gbW9kdWxlLmlkIG5lZWRlZFxuXHRcdC8vIG5vIG1vZHVsZS5sb2FkZWQgbmVlZGVkXG5cdFx0ZXhwb3J0czoge31cblx0fTtcblxuXHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cblx0X193ZWJwYWNrX21vZHVsZXNfX1ttb2R1bGVJZF0obW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cblx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcblx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xufVxuXG4iLCIvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9ucyBmb3IgaGFybW9ueSBleHBvcnRzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLmQgPSAoZXhwb3J0cywgZGVmaW5pdGlvbikgPT4ge1xuXHRmb3IodmFyIGtleSBpbiBkZWZpbml0aW9uKSB7XG5cdFx0aWYoX193ZWJwYWNrX3JlcXVpcmVfXy5vKGRlZmluaXRpb24sIGtleSkgJiYgIV9fd2VicGFja19yZXF1aXJlX18ubyhleHBvcnRzLCBrZXkpKSB7XG5cdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywga2V5LCB7IGVudW1lcmFibGU6IHRydWUsIGdldDogZGVmaW5pdGlvbltrZXldIH0pO1xuXHRcdH1cblx0fVxufTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSAob2JqLCBwcm9wKSA9PiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqLCBwcm9wKSIsIi8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uciA9IChleHBvcnRzKSA9PiB7XG5cdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuXHR9XG5cdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG59OyIsIi8vIHN0YXJ0dXBcbi8vIExvYWQgZW50cnkgbW9kdWxlXG5fX3dlYnBhY2tfcmVxdWlyZV9fKFwiLi9zcmMvaW5kZXgudHNcIik7XG4vLyBUaGlzIGVudHJ5IG1vZHVsZSB1c2VkICdleHBvcnRzJyBzbyBpdCBjYW4ndCBiZSBpbmxpbmVkXG4iXSwic291cmNlUm9vdCI6IiJ9