var lastPlayedSound;

Sound = {
  on: new Sound("sounds/on.mp3", 100, false),
  off: new Sound("sounds/off.mp3", 100, false),
  swap: new Sound("sounds/swap.mp3", 100, false)
}

Mode = {
  Basic: 0,
  Kg: 1
}
State = {
  Idle: 0,
  Work: 1,
  Rest: 2
}

var startTime;
var elapsedTime;
var mode = Mode.Basic;
var state = State.Idle;
var counter = 0;
frame = 0;

$(document).ready(function() {
    setupKeypress();
    setupRadioListener();
    setupTapListener();
});

function setupKeypress() {
  document.onkeypress = function (e) {
    e = e || window.event;
    if (e.code == "Space") {
      if (state == State.Idle) {
        run()
      } else {

      }
    }
  };
}

function setupRadioListener() {
  $('.radio').change(function() {
    switch ($(this).get(0).id) {
      case 'basic':
        mode = Mode.Basic;
        break;
      case 'kg':
        mode = Mode.Kg;
        break;
    }
  });
}

function setState(s) {
  switch (s) {
    case State.Work:
      $("#timer").css("color", "rgb(48, 209, 88)");
      break;
    case State.Rest:
      $("#timer").css("color", "rgb(255, 55, 95)");
      break;
    default:
      $("#timer").css("color", "white");
  }

  state = s;
}

function setupTapListener() {
  $("#block").click(function () {
    run();
  })
}

function run() {
  startTime = Date.now();
  setState(State.Work);
  counter = 0;
  $("#counter").css("color", "rgb(255, 159, 10)");
  setInterval(function() {
    //runChecks();
    elapsedTime = (Date.now() - startTime) / 1000;
    const minutes = `${Math.floor(elapsedTime / 60)}`.padStart(2, "0");
    const seconds = `${(elapsedTime - minutes * 60).toFixed(0)}`.padStart(2, "0");
    $("#timer").html(`${minutes}:${seconds}`);
  }, 100);
}

const plan = [(7, 0), (5, 1), (30, 2), (10, 0)]

function runChecks() {
  var restTime = 0;
  var workTime = 0;

  if (state == State.Work && elapsedTime >= (workTime / 2.0)) {
    if (lastPlayedSound != Sound.swap) {
      Sound.swap.start();
      lastPlayedSound = Sound.swap;
    }
  }
  if (state == State.Work && elapsedTime >= workTime) {
    counter += 1;
    Sound.off.start();
    lastPlayedSound= Sound.off;
    $("#counter").html(counter);
    setState(State.Rest);
    startTime = Date.now();
    elapsedTime = 0;
  }
  if (state == State.Rest && elapsedTime >= restTime) {
    Sound.on.start();
    lastPlayedSound= Sound.on;
    setState(State.Work);
    startTime = Date.now();
    elapsedTime = 0;
  }
}


function Sound(source, volume, loop)
{
    this.source = source;
    this.volume = volume;
    this.loop = loop;
    var son;
    this.son = son;
    this.finish = false;
    this.stop = function()
    {
        document.body.removeChild(this.son);
    }
    this.start = function()
    {
        if (this.finish) return false;
        this.son = document.createElement("embed");
        this.son.setAttribute("src", this.source);
        this.son.setAttribute("hidden", "true");
        this.son.setAttribute("volume", this.volume);
        this.son.setAttribute("autostart", "true");
        this.son.setAttribute("loop", this.loop);
        document.body.appendChild(this.son);
    }
    this.remove=function()
    {
        document.body.removeChild(this.son);
        this.finish = true;
    }
    this.init = function(volume, loop)
    {
        this.finish = false;
        this.volume = volume;
        this.loop = loop;
    }
}
