const getPromisedData = function () {

    return new Promise((resolve, reject) => {

        //resolve('This is ok data');
        reject('This is error data');
    });


}


// getPromisedData().then(okcallback,errrorcallback)

// getPromisedData()
//     .then((dataOK) => {
//         console.log(dataOK);
//     },
//         (dataNOK) => {
//             console.log(dataNOK);
//         }
//     )

getPromisedData()
.then(dataOk => {
     console.log(dataOk);
 })
 .catch(dataNOK => {
     console.log(dataNOK);
 });