(()=>{"use strict";function t(t){return Math.sqrt(t.x*t.x+t.y*t.y)}function o(t){return Math.sqrt(t.x*t.x+t.y*t.y)}for(var a=new(function(){function o(t,o){this.totalDots=t,this.canvas=o,this.dots=[];for(var a=0;a<this.totalDots;a++)this.dots.push({x:(200*Math.random()|0)-100,y:(200*Math.random()|0)-100});this.setupCanvas(),this.draw()}return o.prototype.draw=function(){var o=this.canvas.getContext("2d");o.beginPath(),o.moveTo(10,110),o.lineTo(210,110),o.moveTo(110,10),o.lineTo(110,210),o.stroke(),o.beginPath(),o.moveTo(210,110),o.arc(110,110,100,0,2*Math.PI),o.stroke(),o.beginPath(),o.rect(10,10,200,200),o.stroke();for(var a=0,e=this.dots;a<e.length;a++){var s=e[a];o.beginPath(),t(s)>100?(o.strokeStyle="rgba(194, 24, 7, 0.25)",o.fillStyle="rgba(194, 24, 7, 0.25)"):(o.strokeStyle="rgba(12, 56, 166, 0.25)",o.fillStyle="rgba(12, 56, 166, 0.25)"),o.arc(s.x+110,s.y+110,1,0,2*Math.PI),o.stroke(),o.fill()}},o.prototype.setupCanvas=function(){var t=window.devicePixelRatio,o=this.canvas.getBoundingClientRect();this.canvas.width=o.width*t,this.canvas.height=o.height*t,this.canvas.getContext("2d").scale(t,t)},o}())(1e3,document.querySelector("canvas")),e=0,s=0,i=0,n=a.dots;i<n.length;i++){o(n[i])<=100?e++:s++}console.info({inside:e,outside:s,ratio:e/a.totalDots,fourRatio:e/a.totalDots*4,pi:Math.PI})})();