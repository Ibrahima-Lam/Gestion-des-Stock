window.addEventListener("load", function (e) {
    /*  document.addEventListener('click', function (e) {
         alert("hello")
     }) */
})
async function fetchData(url, callback) {
    const req = await fetch(url)
    const res = await req.json()
    callback(res)
}

