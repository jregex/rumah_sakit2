// Show an element
let show = function (elem) {
	elem.style.display = 'block';
};
// animate fadeIn
function fadeIn2(element, duration = 500) {
    element.style.display = '';
    element.style.opacity = 0;
    let last = +new Date();
    let tick = function() {
      element.style.opacity = +element.style.opacity + (new Date() - last) / duration;
      last = +new Date();
      if (+element.style.opacity < 1) {
        (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
      }
    };
    tick();
}
// Hide an element
let hide = function (elem) {
	elem.style.display = 'none';
};
