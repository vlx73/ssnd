/**
 * This function is to get the data from the server and behave like a async operation
 * @returns {Promise<unknown>}
 */
function getPromisedData() {
    return new Promise((resolveFunc, rejectFunc) => {
        // execute the async operation to get the data
        setTimeout(() => {
            // resolveFunc('Things are good and this is the data');
            rejectFunc('Something went wrong');
        }, 2000);
    });
}


// get the promise object
let promise = getPromisedData();
console.log(promise);

/**
 * Demonstrate the use of .then() method to handle the promise object with two callbacks
 * @param data
 */
console.log('Then with two callbacks');
promise.then(callbackOnOk, callbackOnError)

function callbackOnOk(data) {
    console.log('OK: ', data);
}

function callbackOnError(data) {
    console.log('NOK: ', data);
}

/**
 * Demonstrate the use of .then() method to handle the promise object with one callback and .catch() method
 * @param data
 */
console.log('Then with one callback and catch');
promise
    .then(dataOk => {
        console.log('Then OK: ', dataOk);
    })
    .catch(dataNOK => {
        console.log('Catch NOK: ', dataNOK);
    });
