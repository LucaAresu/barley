document.addEventListener('DOMContentLoaded', dcl => {
    let risorse = async () => {

        let headers = new Headers();
        let init = {
            method: 'POST',
            headers: headers,
            body: JSON.stringify({
                'userId': userId,
                'token' : token
            })
        };
        let request = new Request('ajax/risorse',init);

        await fetch(request).then(resp => {
            if (resp.ok)
                return resp.json();
        }).then(resp => {
            if (resp) {
                document.querySelector('#soldi').innerHTML = resp.soldi;
                document.querySelector('#caffe').innerHTML = resp.caffe;
                document.querySelector('#carote').innerHTML = resp.carote;
                document.querySelector('#clienti').innerHTML = resp.clienti;
                blocco = false;
            }

        }).catch();
        setTimeout(risorse, 1000);
    };
    risorse();
});


