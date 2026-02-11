async function loadUser() {
    try {
        const res = await fetch("/api/user");
        if (!res.ok) {
            throw new Error("HTTP error");
        }
        return await res.json();
    } catch (err) {
        console.error(err);
    }
}

async function loadUser() {
    return "Vlado";
}


loadUser().then(name => console.log(name));


async function loadData() {
    const response = await fetch("/api/data");
    const data = await response.json();
    return data;
}

async function loadUser() {
    try {
        const res = await fetch("/api/user");
        if (!res.ok) {
            throw new Error("HTTP error");
        }
        return await res.json();
    } catch (err) {
        console.error(err);
    }
}

async function http(url, options = {}) {
    const res = await fetch(url, {
        headers: {
            "Content-Type": "application/json",
            ...options.headers,
        },
        ...options,
    });

    if (!res.ok) {
        const errorBody = await res.text();
        throw new Error(errorBody || res.statusText);
    }

    return res.status !== 204 ? res.json() : null;
}

const user = await http("/api/user/1");
