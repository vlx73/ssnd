// // document.addEventListener('readystatechange', (event) => {
// //     console.log('readystatechange event',event);
// //     console.log(event.target.readyState);

// //     if(event.target.readyState === 'complete'){
// //         initApp();
// //     }
// // })

// // const initApp = () => {
// // const div = document.querySelector('div');

// // div.addEventListener('click',(e) => {
// //     console.log(e);
// //     e.target.textContent === 'clicked' ?
// //     e.target.textContent = 'title' :
// //     e.target.textContent = 'clicked';
// // });
// // }
const addButton = document.querySelector('#add');
const newItem = document.querySelector('input');
const ul = document.querySelector('ul');

console.log(newItem.value);




// const items = document.querySelectorAll('li');

// items.forEach((item) => {
    
//     console.log(item.innerText);

//     item.addEventListener('click',(event)=> {
//         console.log(event.target.innerText);
//         item.remove();
//     })
// })



addButton.addEventListener('click',(event)=>{
    const li = document.createElement('li');
    console.log(newItem.value);

    li.innerText = newItem.value;
    ul.append(li);
});

ul.addEventListener('click', (event) => {
console.log(event.target.innerText);
        event.target.remove();
});




// const player = document.querySelector('audio');

// const up = document.querySelector('#up');
// const down = document.querySelector('#down');
// const play = document.querySelector('#play');

// player.addEventListener('play',(event) => {
//     play.textContent = 'PAUSE';
//     console.log('playing');
// });

// player.addEventListener('pause',(event) => {
//     play.textContent = 'PLAY';
//     console.log('pause');
// })

// player.addEventListener('volumechange',(event) => {
// console.log('volumechange event', event.target.volume);
// })



// up.addEventListener('click',(event) => {
//     const player = document.querySelector('audio');
    
//     if(player.volume <= 0.99){
//         player.volume += .01;
//     }
    
//     console.log(player.volume);
// })

// down.addEventListener('click',(event) => {
//     const player = document.querySelector('audio');
    
//     if(player.volume >= 0.01){
//         player.volume -= .01;
//     }
    
//     console.log(player.volume);
// })

// play.addEventListener('click',(event) => {
//     const player = document.querySelector('audio');
//     console.log(player.paused);
//     if(player.paused){
//         player.play();
//         event.target.textContent = "PAUSE"
//     } else {
//         player.pause();
//         event.target.textContent = "PLAY"
//     }
//     });