import process from 'node:process';

console.log('pid:', process.pid);
console.log('argv:', process.argv.slice(2));
console.log('PORT:', process.env.PORT ?? '(unset)');
process.on('SIGINT', () => {
    console.log('SIGINT -> graceful exit');
    process.exit(0);
});
setTimeout(() => console.log('done'), 3000);