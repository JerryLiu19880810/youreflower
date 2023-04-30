(function () {
"use strict";

const wpfp_like_links = document.querySelectorAll('a.wpfp-link[href^="?wpfpaction=add"]')
wpfp_like_links.forEach(function (link) {
    link.setAttribute('title', '收藏')
})

const wpfp_unlike_links = document.querySelectorAll('a.wpfp-link[href^="?wpfpaction=remove"]')
wpfp_unlike_links.forEach(function (link) {
    link.setAttribute('title', '取消收藏')
})

//page-collection
const wpfp_unlike_links_in_page_collection = document.querySelectorAll('.page-collection a.wpfp-link[href^="?wpfpaction=remove"]')
wpfp_unlike_links_in_page_collection.forEach(function (link) {
    link.addEventListener('click', function (e) {
        e.preventDefault()
        //console.log(e.target.closest('.product.col-6'), '準備移除')
        e.target.closest('.product.col-6').style.display = 'none'
        //console.log(e.target.closest('.product.col-6'), '已移除')

    })
})

})();