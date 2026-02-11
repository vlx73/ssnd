// import toho čo utils.js exportuje
import { pozdrav, PI } from './utils.js';

console.log(pozdrav("Eva"));
console.log(`Hodnota PI je ${PI}`);

const logger = function (){
    console.log('test 2');
}
setTimeout(logger,5000);