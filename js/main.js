document.addEventListener('DOMContentLoaded', dcl => {
    let risorse = async () => {
        let togliVirgole = num => {
             return parseInt(num.replace(/,/g,''));
        };
        let checkBottoni = soldi => {
            soldi= togliVirgole(soldi);
            let divs = document.querySelectorAll('.card');
            for(let ele of divs) {
              let costo = ele.querySelector('.costo').innerHTML;
              costo = togliVirgole(costo);
              if(soldi > costo) {
                  let bottoni = ele.querySelectorAll('button');
                  for(let button of bottoni) {
                      button.disabled = false;
                  }
              }

          }
        };

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
                for(let key of Object.keys(resp))
                    document.querySelector('#'+key).innerHTML = resp[key];
                checkBottoni(resp.soldi);
                blocco = false;
            }

        }).catch();
        setTimeout(risorse, 1000);
    };
    risorse();
});


