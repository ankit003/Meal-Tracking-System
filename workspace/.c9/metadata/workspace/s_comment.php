{"filter":false,"title":"s_comment.php","tooltip":"/s_comment.php","undoManager":{"mark":6,"position":6,"stack":[[{"start":{"row":20,"column":0},"end":{"row":20,"column":1},"action":"insert","lines":["/"],"id":427}],[{"start":{"row":20,"column":1},"end":{"row":20,"column":2},"action":"insert","lines":["/"],"id":428}],[{"start":{"row":13,"column":1},"end":{"row":15,"column":35},"action":"remove","lines":["$ann=\"select * from ANNOUNCEMENT where MESS_NO='$mess'\";","\t$annres=mysql_query($ann);","\t$anncount=mysql_num_rows($annres);"],"id":429},{"start":{"row":13,"column":1},"end":{"row":16,"column":35},"action":"insert","lines":["$ann=\"select * from ANNOUNCEMENT where MESS_NO='$mess'\";","\t","\t$annres=mysql_query($ann);","\t$anncount=mysql_num_rows($annres);"]}],[{"start":{"row":14,"column":0},"end":{"row":14,"column":1},"action":"remove","lines":["\t"],"id":430}],[{"start":{"row":13,"column":57},"end":{"row":14,"column":0},"action":"remove","lines":["",""],"id":431}],[{"start":{"row":114,"column":2},"end":{"row":139,"column":8},"action":"remove","lines":["<div id=\"sidebar\">","\t\t\t<div class=\"box1\">","\t\t\t\t<div class=\"title\">","\t\t\t\t\t<center><h2>Announcement</h2></center>","\t\t\t\t</div>","\t\t\t\t<ul>","\t\t\t\t\t<marquee style=\"height: 410px;\" behavior=\"scroll\" direction=\"up\" scrollamount=\"2\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\">","\t\t\t\t\t\t<li>","\t\t\t\t\t\t\t<?php","\t\t\t\t\t\t\tfor($i=0;$i<$anncount;$i++)","\t\t\t\t\t\t\t{","\t\t\t\t\t\t\t$row1=mysql_fetch_array($annres);","\t\t\t\t\t\t\t?> ","\t\t\t\t\t\t\t<span><?php echo $row1['DATE'];  ?></span>","\t\t\t\t\t\t\t<h4> <?php echo $row1['HEADING']; ?>  </h4>","\t\t\t\t\t\t\t<p>","\t\t\t\t\t\t\t\t <?php echo $row1['ANNOUNCEMENT']   ?>","\t\t\t\t\t\t\t</p>","\t\t\t\t\t\t</li> ","\t\t\t\t\t\t<?php","\t\t\t\t\t\t}     ","\t\t\t\t\t\t?>","\t\t\t\t</marquee>\t","\t\t\t\t</ul>","\t\t\t</div>","\t\t</div>"],"id":432},{"start":{"row":114,"column":2},"end":{"row":139,"column":8},"action":"insert","lines":["<div id=\"sidebar\">","\t\t\t<div class=\"box1\">","\t\t\t\t<div class=\"title\">","\t\t\t\t\t<center><h2>Announcement</h2></center>","\t\t\t\t</div>","\t\t\t\t<ul>","\t\t\t\t\t<marquee style=\"height: 410px;\" behavior=\"scroll\" direction=\"up\" scrollamount=\"2\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\">","\t\t\t\t\t\t<li>","\t\t\t\t\t\t\t<?php","\t\t\t\t\t\t\tfor($i=0;$i<$anncount;$i++)","\t\t\t\t\t\t\t{","\t\t\t\t\t\t\t$row1=mysql_fetch_array($annres);","\t\t\t\t\t\t\t?> ","\t\t\t\t\t\t\t<span><?php echo $row1['DATE'];  ?></span>","\t\t\t\t\t\t\t<h4> <?php echo $row1['HEADING']; ?>  </h4>","\t\t\t\t\t\t\t<p>","\t\t\t\t\t\t\t\t <?php echo $row1['ANNOUNCEMENT']   ?>","\t\t\t\t\t\t\t</p>","\t\t\t\t\t\t</li> ","\t\t\t\t\t\t<?php","\t\t\t\t\t\t}     ","\t\t\t\t\t\t?>","\t\t\t\t</marquee>\t","\t\t\t\t</ul>","\t\t\t</div>","\t\t</div>"]}],[{"start":{"row":8,"column":27},"end":{"row":8,"column":28},"action":"insert","lines":["s"],"id":433}]]},"ace":{"folds":[],"scrolltop":176,"scrollleft":0,"selection":{"start":{"row":8,"column":28},"end":{"row":8,"column":28},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1510562713566,"hash":"25885b69fac0295ab6f0fd223cf8a2b52aa12a44"}