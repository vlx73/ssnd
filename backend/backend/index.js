import http from "node:http";
import process from "node:process";
import {readFile} from "node:fs/promises";

const PORT = process.env.PORT ? Number(process.env.PORT) : 8080;

console.log('pid: ', process.pid);
console.log('starting server on port', PORT);


const server = http.createServer(async (request, response) => {

    console.log(request.url);

    // strip from the url the leading /api part
    request.url = request.url.replace(/^\/api/, "");

    // plain text example
    if (request.method === 'GET' && request.url === "/text") {
        console.log(request.headers["authorization"] || "no auth")
        response.writeHead(200, {"content-type": "text/plain; charset=utf-8"});
        response.write("Hello World!\n");
        response.end();
    }

    // json example
    if (request.method === 'GET' && request.url === "/health") {
        response.writeHead(200, {"content-type": "application/json; charset=utf-8"});
        // return current time and ok
        response.write(JSON.stringify({time: new Date().toISOString()}));
        response.end();
    }

    // html example
    if (request.method === 'GET' && request.url === "/html") {
        const html = await readFile("public/index.html", "utf-8");
        response.writeHead(200, {"content-type": "text/html; charset=utf-8"});
        // return full html page with hallo world
        response.end(html);
    }

    // fallback for other routes
    if (!response.writableEnded) {
        response.writeHead(404, {"content-type": "text/plain; charset=utf-8"});
        response.end(`Not Found: ${request.url}\n`);
    }

})

server.listen(PORT, "0.0.0.0", () => {
    console.log(`[authentication] listening on ${PORT}`);
});
