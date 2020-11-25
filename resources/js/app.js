require('./bootstrap');


window.addEventListener('error', (ev)=>{
    toastr.options.closeButton = true;
    toastr.options.timeOut = 1000;
    toastr.error(ev.detail.message);
})
window.addEventListener('warning', (ev)=>{
    toastr.options.closeButton = true;
    toastr.options.timeOut = 1000;
    toastr.warning(ev.detail.message);
})
window.addEventListener('success', (ev)=>{
    toastr.options.closeButton = true;
    toastr.options.timeOut = 1000;
    toastr.success(ev.detail.message);
})