var button=document.getElementById("commandSmallScreen");
var menu=document.getElementById("menu");

button.addEventListener("click", function(){
	if(menu.className==="navbar-collapse collapse")
	{
		menu.className="navbar-collapse collapse in";
	}
	else
	{
		menu.className="navbar-collapse collapse";
	}
});