let TransformStreamPromise = Promise.resolve().then(() => {

if('TransformeStream' in self) {
  return self.TransformeStream;
}

const {TransformeStream} = await import('/stream-module.js');
return TransformeStream;
});

(async function () {
  const ts = new (await TransformStreamPromise)(/*...*/);

})(); //auto invoke
