let demoNumber = 0;
let counter = 0;
// demo 1 - event listener
document.getElementById("btn").addEventListener("click", function () {
        document.getElementById("output").textContent = "Ahoj! Klikol si na tlačidlo 😊";
    }
);


// demo 2 - event listener with call back function
document.querySelectorAll("button").forEach(
    button => button.addEventListener(
        "click",
        event => document.querySelector("h3").textContent = `Počet kliknutí ${counter++}`
    )
);


// helper function to show next demo
function nextDemo() {
    if (demoNumber > 0) {
        document.querySelector("#demo-" + demoNumber).style.display = "none";
    }
    demoNumber++;
    document.querySelector("#demo-" + demoNumber).style.display = "block";

    switch (demoNumber) {
        case 4:
            // event listener for input event
            const nameInput = document.getElementById("name");
            nameInput.addEventListener("input", function () {
                document.getElementById("greet").textContent = "Ahoj, " + nameInput.value + " 👋";
            });
            break;

        case 5:
            // demo 5 - event listener mouse events
            const box = document.getElementById("box");

            box.addEventListener("mouseenter", () => box.style.background = "orange");
            box.addEventListener("mouseleave", () => box.style.background = "skyblue");
            box.addEventListener("click", () => box.classList.toggle("clickable"));
            break;

        case 6:
            const colors = ["red", "orange", "green"];
            let index = 0;

            document.getElementById("policajt").addEventListener("click", function () {
                index = (index + 1) % colors.length;
                // console.log(index);
                document.getElementById("semafor").style.background = colors[index];
            });
            break;
        case 7:
            document.addEventListener("mousemove", e => {
                document.getElementById("axis-x").textContent = e.clientX;
                document.getElementById("axis-y").textContent = e.clientY;
                document.body.style.backgroundColor = `rgb(${e.clientX % 255}, ${e.clientY % 255}, 150)`;
            });

            event.target.textContent = "Toto je posledné demo"
            event.target.style.opacity = 0.6;
            event.target.disabled = true;

            break;
    }
}

document.querySelector("#next").addEventListener("click", nextDemo);




