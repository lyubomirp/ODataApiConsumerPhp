function fetchData(el) {
    document.getElementsByClassName('loading')[0].classList.remove('hidden');
    const xhttp = new XMLHttpRequest();
    const data  = { param: el.innerHTML, direction: el.dataset.direction};

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log(document.getElementById('container'));
            document.getElementById('container').innerHTML = this.responseText;
            document.getElementsByClassName('loading')[0].classList.add('hidden');
        }
    };

    xhttp.open('POST', `/fetch-data`, true);
    xhttp.setRequestHeader('Content-type', 'application/json');
    xhttp.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="_token"]').content)
    xhttp.send(JSON.stringify(data));

    el.dataset.direction = Number(el.dataset.direction) + 1;

    if (el.dataset.direction > 2) {
        el.dataset.direction = 0;
    }
}

Object.values(document.getElementsByClassName("table-header")).forEach(entry => {
    entry.addEventListener("click", (e) => fetchData(e.target), false);
  });

  document.getElementsByClassName('loading')[0].classList.add('hidden');
