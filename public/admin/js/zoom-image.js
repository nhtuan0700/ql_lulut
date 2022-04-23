function ZoomImage(selector, previewZoom) {
  var divZoomImg = document.querySelector(selector);
  divZoomImg.addEventListener('click', function (e) {
    let elmTarget = e.target;
    let elmPreviewZoom = document.querySelector(previewZoom);
    if (elmTarget.tagName.toLowerCase() == 'img') {
      elmPreviewZoom.querySelector('img').src = elmTarget.src;
      $(elmPreviewZoom).modal({
        show: true
      })
    }
  })
}