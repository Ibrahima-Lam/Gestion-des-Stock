export async function fetchData(url, callback) {
    const req = await fetch(url)
    const res = await req.json()
    callback(res)
}