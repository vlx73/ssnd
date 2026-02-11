import http from "node:http";

const PORT = process.env.PORT ? Number(process.env.PORT) : 8080;

http.createServer((req, res) => {
    res.writeHead(200, { "content-type": "text/plain; charset=utf-8" });
    res.end("authentication\n");
}).listen(PORT, "0.0.0.0", () => {
    console.log(`[authentication] listening on ${PORT}`);
});
