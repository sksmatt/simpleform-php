/* checkform - written by Matt Varone (http://www.mattvarone.com) */
/* cssjs - written by Christian Heilmann (http://icant.co.uk) */
function checkform(thisForm,alertText)
{var passed=true;var selected=false;var checked=false;var next,eLabel,type,responce,checked;var errorClass="error";if(alertText===undefined)alertText='#name is a required field.';var requireds=thisForm.elements["validate"].value;var required=requireds.split("|");for(var i in required)
{var req=required[i].split("::");var field=thisForm.elements[req[0]];var fType=thisForm.elements[req[0]].type;if(fType===undefined){fType=thisForm.elements[req[0]][0].type;};if(fType!==undefined)
{if(fType=="text"||fType=="select-one"||fType=="textarea")
{if(fType=="text"&&req[0].indexOf("email")!=-1)
{var at=field.value.indexOf("@");if(at==-1)
{dataFailed(field,req[1]);type='email';}else{dataPassed(field);}}else{checkInput(field,req[1]);}}else if(fType=="radio"||fType=="checkbox"){var eLength=thisForm.elements[req[0]].length;for(i=0;i<eLength;i++)
{if(fType=="radio"&&thisForm.elements[req[0]][i].checked)
{selected=true;}
if(fType=="checkbox"&&thisForm.elements[req[0]][i].checked)
{checked=true;}}
if(fType=="radio"){if(selected==false){dataFailed(field[0],req[1]);};};if(fType=="checkbox"){if(checked==false){dataFailed(field[0],req[1]);};};}}}
if(passed==false)
{responce=alertText.replace('#name',eLabel);alert(responce);next.focus();return false;}else{return true;}
function checkInput(field,title)
{var input=field.value.replace(/^\s+|-|\s+$/g,'');if(input=="")
{dataFailed(field,title);}else{dataPassed(field);}}
function dataFailed(field,title)
{passed=false;cssjs('add',field,errorClass);if(next==null)
{next=field;eLabel=title;};}
function dataPassed(field)
{cssjs('remove',field,errorClass);}
function cssjs(a,o,c1,c2)
{switch(a){case'swap':o.className=!cssjs('check',o,c1)?o.className.replace(c2,c1):o.className.replace(c1,c2);break;case'add':if(!cssjs('check',o,c1)){o.className+=o.className?' '+c1:c1;}
break;case'remove':var rep=o.className.match(' '+c1)?' '+c1:c1;o.className=o.className.replace(rep,'');break;case'check':return new RegExp('\\b'+c1+'\\b').test(o.className)
break;}}}