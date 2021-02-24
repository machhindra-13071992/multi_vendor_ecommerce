(function () {
    var $momentum;

    function createWorker() {
        var containerFunction = function () {
            var idMap = {};

            self.onmessage = function (e) {
                if (e.data.type === 'setInterval') {
                    idMap[e.data.id] = setInterval(function () {
                        self.postMessage({
                            type: 'fire',
                            id: e.data.id
                        });
                    }, e.data.delay);
                } else if (e.data.type === 'clearInterval') {
                    clearInterval(idMap[e.data.id]);
                    delete idMap[e.data.id];
                } else if (e.data.type === 'setTimeout') {
                    idMap[e.data.id] = setTimeout(function () {
                        self.postMessage({
                            type: 'fire',
                            id: e.data.id
                        });
                        // remove reference to this timeout after is finished
                        delete idMap[e.data.id];
                    }, e.data.delay);
                } else if (e.data.type === 'clearCallback') {
                    clearTimeout(idMap[e.data.id]);
                    delete idMap[e.data.id];
                }
            };
        };

        return new Worker(URL.createObjectURL(new Blob([
            '(',
            containerFunction.toString(),
            ')();'
        ], {type: 'application/javascript'})));
    }

    $momentum = {
        worker: createWorker(),
        idToCallback: {},
        currentId: 0
    };

    function generateId() {
        return $momentum.currentId++;
    }

    function patchedSetInterval(callback, delay) {
        var intervalId = generateId();

        $momentum.idToCallback[intervalId] = callback;
        $momentum.worker.postMessage({
            type: 'setInterval',
            delay: delay,
            id: intervalId
        });
        return intervalId;
    }

    function patchedClearInterval(intervalId) {
        $momentum.worker.postMessage({
            type: 'clearInterval',
            id: intervalId
        });

        delete $momentum.idToCallback[intervalId];
    }

    function patchedSetTimeout(callback, delay) {
        var intervalId = generateId();

        $momentum.idToCallback[intervalId] = function () {
            callback();
            delete $momentum.idToCallback[intervalId];
        };

        $momentum.worker.postMessage({
            type: 'setTimeout',
            delay: delay,
            id: intervalId
        });
        return intervalId;
    }

    function patchedClearTimeout(intervalId) {
        $momentum.worker.postMessage({
            type: 'clearInterval',
            id: intervalId
        });

        delete $momentum.idToCallback[intervalId];
    }

    $momentum.worker.onmessage = function (e) {
        if (e.data.type === 'fire') {
            $momentum.idToCallback[e.data.id]();
        }
    };

    window.$momentum = $momentum;

    window.setInterval = patchedSetInterval;
    window.clearInterval = patchedClearInterval;
    window.setTimeout = patchedSetTimeout;
    window.clearTimeout = patchedClearTimeout;
})();

var timer = function  ( timerName ) {
    this.hour = 0;
    this.min = 0;
    this.seconds = 0;
    this.miliseconds = 0;
    this.totalMiliSeconds = 0;
    this.intervalId = null;
    this.runningFlag = false;
    this.pauseFlag = false;

    this.startButtonId = '';
    this.pauseButtonId = '';
    this.stopButtonId = '';
    this.resetButtonId = '';

    this.miliSecondInput = '';
    this.secondInput = '';
    this.minInput = '';
    this.hourInput = '';
    this.timerName = timerName;

    this.timerStartedFlag = false;

    this.pauseTimer = function () {
        var self = this;
        if(!self.runningFlag){
            return false;
        }
        clearInterval(self.intervalId);
        self.pauseFlag = true;
        self.intervalId = null;
    }

    this.stopTimer = function () {
        var self = this;
        if(!self.runningFlag){
            return false;
        }
        self.totalMiliSeconds = self.miliseconds;
        self.hour = 0;
        self.min = 0;
        self.seconds = 0;
        self.miliseconds = 0;
        clearInterval(self.intervalId);
        self.intervalId = null;
        self.runningFlag = false;
        self.pauseFlag = false;

        // $('#'+self.miliSecondInput).html('00');
        $('#'+self.secondInput).html('00');
        $('#'+self.minInput).html('00');
        $('#'+self.hourInput).html('00');
    }

    this.startTimer = function () {
        var self  = this;
        var incrTimer = function () {
            self.miliseconds = self.miliseconds + 100;
            var miliseconds = self.padZero(parseInt((self.miliseconds % 1000) /10), 2);
            var seconds = self.padZero(Math.floor((self.miliseconds / 1000) %60), 2);
            var minute = self.padZero(Math.floor((self.miliseconds / (1000 * 60)) % 60), 2);
            var hour = self.padZero(Math.floor((self.miliseconds / (1000 * 60 * 60))), 2);

            // $('#'+self.miliSecondInput).html(miliseconds);
            $('#'+self.secondInput).html(seconds);
            $('#'+self.minInput).html(minute);
            $('#'+self.hourInput).html(hour);
        }
        self.intervalId = setInterval(incrTimer, 100);
        self.runningFlag = true;
    }

    this.updateStartTime = function () {
        var self = this;
        self.miliseconds = self.miliseconds;
        var miliseconds = self.padZero(parseInt((self.miliseconds % 1000) /10), 2);
        var seconds = self.padZero(Math.floor((self.miliseconds / 1000) %60), 2);
        var minute = self.padZero(Math.floor((self.miliseconds / (1000 * 60)) % 60), 2);
        var hour = self.padZero(Math.floor((self.miliseconds / (1000 * 60 * 60))), 2);
  
        //$('#'+self.miliSecondInput).html(miliseconds);
        $('#'+self.secondInput).html(seconds);
        $('#'+self.minInput).html(minute);
        $('#'+self.hourInput).html(hour);
    }

    this.generateHtml = function (timerName) {
        var self =  this;
        self.startButtonId = timerName + 'StartButton';
        self.pauseButtonId = timerName + 'PauseButton';
        self.stopButtonId = timerName + 'StopButton';

        self.miliSecondInput = timerName+'MiliSecondInput';
        self.secondInput = timerName+'secondInput';
        self.minInput = timerName+'MinInput';
        self.hourInput = timerName+'HourInput';

        
        // $('#'+timerName+'Container').html('<div class="row"><div class="col-sm-12 timerCounterRow"><span id="' + self.hourInput + '">00</span>: <span id="' + self.minInput + '">00</span> : <span id="' + self.secondInput + '">00</span> : <span id="' + self.miliSecondInput + '">00</span></div></div><div class="row"><div class="col-sm-12 timerCounterButtonGroup"><button class="btn btn-sm btn-success" id="' + self.startButtonId + '">Start</button>&nbsp;<button class="btn btn-sm btn-warning" id="' + self.pauseButtonId + '">Pause</button>&nbsp;<button class="btn btn-sm btn-danger" id="' + self.stopButtonId + '">Stop</button></div></div>');
        $('#'+timerName+'Container').html('<div class="row"><div class="col-sm-12 timerCounterRow"><span id="' + self.hourInput + '">00</span> : <span id="' + self.minInput + '">00</span> : <span id="' + self.secondInput + '">00</span></div></div><div class="row"><div class="col-sm-12 timerCounterButtonGroup"><button class="btn btn-sm btn-success" id="' + self.startButtonId + '">Start</button>&nbsp;<button class="btn btn-sm btn-danger" id="' + self.pauseButtonId + '">Stop</button></div></div>');
    }
	
	this.getTotalMiliseconds = function () {
		return this.totalMiliSeconds;
	}
    
    this.getMiliSeconds = function () {
		return this.miliseconds;
	}

    this.padZero = function (n, w) {
        var z = '0';
        n = n + '';
        return n.length >= w ? n : new Array(w - n.length + 1).join(z) + n;
    }

    this.setTimerStarted = function(flag) {
        var self = this;
        self.timerStartedFlag = flag;
    }

    this.getTimerStarted = function () {
        var self = this;
        return self.timerStartedFlag;
    }

    this.init = function (startTime) {
        var self = this;
        self.generateHtml(self.timerName);
        if(startTime && !isNaN(startTime) && startTime > 100) {
            self.miliseconds = parseInt(startTime);
            self.updateStartTime();
        }
        $(document).off('click', '#'+ self.startButtonId).on('click', '#'+ self.startButtonId, function () {
            self.setTimerStarted(true);
            if(self.pauseFlag) {
                if(self.runningFlag) {
                    self.startTimer();
                    self.pauseFlag = false;
                }
                return false;
            }
            else {
                if(!self.runningFlag) {
                    self.startTimer();
                }
                return false;
            }
        });
        $(document).off('click', '#'+ self.pauseButtonId).on('click', '#'+ self.pauseButtonId, function () {
            self.pauseTimer();
            return false;
        });
        $(document).off('click', '#'+ self.stopButtonId).on('click', '#'+ self.stopButtonId, function () {
            self.stopTimer();
            return false;
        });
    }
}