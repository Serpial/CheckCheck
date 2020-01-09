<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, minimal-ui, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>CheckCheck</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600">
    <link rel="stylesheet" href="css/reset.css?v2">
    <link rel="stylesheet" href="css/global.css?v2">

    <link rel="apple-touch-icon" href="logo.png" />
    <link rel="shortcut icon" type="image/x-icon" href="logo.png" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-21727306-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-21727306-1');
    </script>
  </head>

  <body>
    <header>
      <div class="container">
        <a href="/check" class="logo">
          CheckCheck
        </a>
      </div>
    </header>

    <div class="container">
      <main>
        <p class="headline">Enter a shelf location to find it's check character.</p>

        <div class="location-box">
          <div class="location-box-main">
            <input type="text" maxlength="4" class="location-name" name="location-name" id="location-name" value="NULL">

            <p class="location-text">&ldquo;<span id="location-text">NULL</span>&rdquo;</p>

            <div id="check-char" class="check-char">
              NULL
            </div>
          </div>
        </div>

        <h4 id="similar-locations-title"><span class="expand-arrow" id="similar-locations-arrow">></span> Similar Locations</h4>
        <div id="similar-locations-box">
          <h5>This is a list of locations with the same check digit as the location above</h5>
          <div id="similar-locations-naughts"><span class="expand-arrow" id="sla-naughts">></span> 00s</div>
          <div class="locations-box" id="naughts-box"></div>
          <div id="similar-locations-tens"><span class="expand-arrow" id="sla-tens">></span> 10s</div>
          <div class="locations-box" id="tens-box"></div>
          <div id="similar-locations-twenties"><span class="expand-arrow" id="sla-twenties">></span> 20s</div>
          <div class="locations-box" id="twenties-box"></div>
          <div id="similar-locations-thirties"><span class="expand-arrow" id="sla-thirties">></span> 30s</div>
          <div class="locations-box" id="thirties-box"></div>
          <div id="similar-locations-forties"><span class="expand-arrow" id="sla-forties">></span> 40s</div>
          <div class="locations-box" id="forties-box"></div>
          <div id="similar-locations-fifties"><span class="expand-arrow" id="sla-fifties">></span> 50s</div>
          <div class="locations-box" id="fifties-box"></div>
          <div id="similar-locations-sixties"><span class="expand-arrow" id="sla-sixties">></span> 60s</div>
          <div class="locations-box" id="sixties-box"></div>
          <div id="similar-locations-seventies"><span class="expand-arrow" id="sla-seventies">></span> 70s</div>
          <div class="locations-box" id="seventies-box"></div>
          <div id="similar-locations-eighties"><span class="expand-arrow" id="sla-eighties">></span> 80s</div>
          <div class="locations-box" id="eighties-box"></div>
          <div id="similar-locations-nineties"><span class="expand-arrow" id="sla-nineties">></span> 90s</div>
          <div class="locations-box" id="nineties-box"></div>
        </div>
      </main>

      <footer>
        Designed and developed by <a href="http://markwrites.codes" target="_blank">Mark Eriksson</a>.

        <div class="adspace">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- CheckCheck Ads -->
          <ins class="adsbygoogle"
          style="display:inline-block;margin:0 auto;width:320px;height:100px"
          data-ad-client="ca-pub-4959011941735218"
          data-ad-slot="4988962960"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
      </footer>
    </div>
  </body>

  <script>
    const phonetic = ['ALPHA', 'BRAVO', 'CHARLIE', 'DELTA', 'ECHO', 'FOXTROT', 'GOLF', 'HOTEL', 'INDIA', 'JULIET', 'KILO', 'LIMA', 'MIKE', 'NOVEMBER', 'OSCAR', 'PAPA', 'QUEBEC', 'ROMEO', 'SIERRA', 'TANGO', 'UNIFORM', 'VICTOR', 'WHISKEY', 'X-RAY', 'YANKEE', 'ZULU'];
    const numbers  = ['ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
    const numberIds = ["naughts","tens","twenties","thirties","forties","fifties","sixties","seventies","eighties","nineties"];
    var locationString = '';

    function getPhonetic(l) {
      for (q=0;q<phonetic.length;q++) {
        if (phonetic[q].substr(0,1) === l) {
          return phonetic[q];
          break;
        }
      }
    }

    function fromPhonetic(l) {
      var c = String.fromCharCode(
        phonetic.findIndex(i => i==l)+65
      );
      return c;
    }

    function getLocationName(e) {
      var location  = document.getElementById('location-name').value.toUpperCase(),
          locSplit  = e.split(' '),
          firstChar = location.substr(0,1),
          lastChar  = location.substr(-1),
          returnVal = e,
          checkChar = document.getElementById('check-char');

      //check for jewellery, security, linbins, bulk
      if (firstChar === "J" || firstChar === "S" || firstChar === "L" || firstChar === "Z") {
        switch (firstChar) {
          case 'J':
            returnVal = 'JEWELLERY ' + [locSplit[1], locSplit[2], locSplit[3]].join(' ');
          break;

          case 'S':
            returnVal = 'SECURITY ' + [locSplit[1], locSplit[2], locSplit[3]].join(' ');
          break;

          case 'L':
            returnVal = [locSplit[1], locSplit[2]].join(' ') + ' LINBIN ' + locSplit[3];
          break;

          case 'Z':
            returnVal = [locSplit[1], locSplit[2]].join(' ') + ' BULK ' + locSplit[3];
          break;
        }
      }
      
      //check for after,before
      if (lastChar === "+" || lastChar === "-") {
        switch (lastChar) {
          case '+':
            returnVal = 'AFTER ' + [locSplit[0], locSplit[1], locSplit[2]].join(' ');
          break;

          case '-':
            returnVal = 'BEFORE ' + [locSplit[0], locSplit[1], locSplit[2]].join(' ');
          break;
        }
      }
      
      //check for misc locations
      if (location.substr(0,2) == 'CA') {
        returnVal = 'CASH OFFICE ' + [locSplit[2], locSplit[3]].join(' ');
      }
      
      if (location === 'RETS') {
        returnVal = 'RETURNS';
      }
      
      if (location.substr(0,3) === 'DPA') {
        returnVal = 'DPA';
        checkChar.innerText = 'VICTOR';
      }
      
      if (location.substr(0,3) === 'SOB') {
        returnVal = 'SOB';
        checkChar.innerText = 'SIERRA';
      }
      
      return returnVal;
    }

    function updateList(c) {
      if (c != "@") {
        var locations=[""];
        var isle;
        document.getElementById('similar-locations-title').onclick = unfoldSimilarLocations;

        for (var i=1; i<100; i++) {
          isle = (i<10? "0"+i: i+"");
          
          locations[Math.floor(i/10)] += '<div class="isle-locations"><span class="isle-name">'+isle+'</span>';
          locations[Math.floor(i/10)] += ' : '+getBays(isle, c)+'</div>';

          // Add an extra spot in the array
          if (i % 9 == 0 && (i+1) < 100) { locations[Math.floor(i/10)+1] = ""; }
        }
        for (var i=0; i<10; i++) {
          document.getElementById(numberIds[i]+'-box').innerHTML = locations[i];
        }
      } else {
        document.getElementById('similar-locations-title').onclick = null;
      }
    }

    function getBays(isle, chkChar) {
      var baysInIsle = "";

      for (var j=65; j<91; j++) {
        // Get Column
        var col = String.fromCharCode(j);
        for (var k=65; k<91; k++) {
          // Get Row
          var row = String.fromCharCode(k);
          var location = isle+col+row;
          var m = 0;

          for (var l=2; l<6; l++) {
            m+=(location.charCodeAt(l%4)) * (l%3*2+3);
          }
          if (String.fromCharCode(m%26+65) == chkChar) {
            baysInIsle += location.substring(2,4)+", ";
          }
        }
      }

      return baysInIsle;
    }
    
    function unfoldSimilarLocations() {
      var dropdownCont = document.getElementById('similar-locations-box').style;
      var currentCheckChar = document.getElementById("check-char").innerText;
      var folded = dropdownCont.display == 'none' || dropdownCont.display == '';

      if (currentCheckChar != "NULL") {
        document.getElementById('similar-locations-arrow').classList.toggle('rotated');

        if (folded) {
          updateList(fromPhonetic(currentCheckChar));
          dropdownCont.display = 'block';
        } else {
          dropdownCont.display = 'none';
        }
      }
    }

    function foldThis() {
      var num = this.id.substring(this.id.indexOf('-')+2).substring(this.id.indexOf('-')+2);
      var boxStyle = document.getElementById(num+'-box').style;
      var folded = boxStyle.display == 'none' || boxStyle.display == '';
      document.getElementById('sla-'+num).classList.toggle('rotated');
      if (folded) {
        boxStyle.display = 'block';
      } else {
        boxStyle.display = 'none';
      }
    }

    document.getElementById('location-name').addEventListener('input', function(e) {
      var self = this,
          locationText = document.getElementById('location-text'),
          checkChar = document.getElementById('check-char'),
          location = self.value.toUpperCase(),
          i = 0;

      self.value = location.replace(/[^a-zA-Z0-9_+-]/g, '');

      if (this.value.length > 3 || this.value === "DPA" || this.value === "SOB") {
        for (k=2;k<6;k++) {
          i+=(location.charCodeAt(k%4)) * (k%3*2+3);
          locationString += ((!!isNaN(c=location[k-2])) ? getPhonetic(c) : numbers[c]) + ' ';
        }
        
        check = String.fromCharCode(i%26+65)
        checkChar.innerText = getPhonetic(check);
        locationString = locationString.replace(/\s$/, '');
        locationText.innerText = getLocationName(locationString);
        locationString = '';
        document.getElementById('similar-locations-title').onclick = unfoldSimilarLocations;
        updateList(check);
      } else {
        locationText.innerText = checkChar.innerText = 'NULL';
        if (document.getElementById('similar-locations-box').style.display != 'none' &&
        document.getElementById('similar-locations-box').style.display != '') {
          document.getElementById('similar-locations-title').onclick = null;
          document.getElementById('similar-locations-arrow').classList.toggle('rotated');
          document.getElementById('similar-locations-box').style.display = 'none';
        }
      }

      e.preventDefault();
    });

    document.getElementById('location-name').addEventListener('focus', function(e) {
      this.value === 'NULL' && (this.value = '');
    });

    document.getElementById('location-name').addEventListener('blur', function(e) {
      this.value === "" && (this.value = 'NULL');
    });

    for(var i=0; i<10; i++) {
      document.getElementById('similar-locations-'+numberIds[i]).onclick = foldThis;
    }

  </script>
</html>
