function notHidden(id) {
    var y = document.getElementById("cardAvtr" + id);
    y.hidden = true;
    var z = document.getElementById("cardTitle" + id);
    z.hidden = true;
    var a = document.getElementById("cardSubtitle" + id);
    a.hidden = true;

    var b = document.getElementById("btn" + id);
    b.hidden = false;
    var x = document.getElementById("descr" + id);
    x.hidden = false;
  }
  function hide(id) {
    var y = document.getElementById("cardAvtr" + id);
    y.hidden = false;
    var z = document.getElementById("cardTitle" + id);
    z.hidden = false;
    var a = document.getElementById("cardSubtitle" + id);
    a.hidden = false;

    var b = document.getElementById("btn" + id);
    b.hidden = true;
    var x = document.getElementById("descr" + id);
    x.hidden = true;
  }
