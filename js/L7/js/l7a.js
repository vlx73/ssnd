/*
 * audioplayer demnostration
 */

const player = document.querySelector('audio');

const up = document.querySelector('#volumeUp');
const down = document.querySelector('#volumeDown');
const play = document.querySelector('#play');
const volumeIndicator = document.querySelector('.volumeIndicator');

// listerner for play button
player.addEventListener('play',(event) => {
    play.textContent = 'PAUSE';
    console.log('playing');
});

player.addEventListener('pause',(event) => {
    play.textContent = 'PLAY';
    console.log('pause');
})

// listerner for volume change
player.addEventListener('volumechange',(event) => {
console.log('volumechange event', event.target.volume);
})


// listerner for volume up button
up.addEventListener('click',(event) => {
    const player = document.querySelector('audio');

    if(player.volume <= 0.99){
        player.volume += .01;
    }

    console.log(player.volume);
})

// listerner for volume down button
down.addEventListener('click',(event) => {
    const player = document.querySelector('audio');

    if(player.volume >= 0.01){
        player.volume -= .01;
    }

    console.log(player.volume);
})

play.addEventListener('click',(event) => {
    const player = document.querySelector('audio');
    console.log(player.paused);
    if(player.paused){
        player.play();
        event.target.textContent = "PAUSE"
    } else {
        player.pause();
        event.target.textContent = "PLAY"
    }
    });