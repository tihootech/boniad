@master

<li>
	<a class="app-menu__item @if(rn() == 'green_management') active @endif" href="{{route("green_management")}}">
		<i class="ml-2 material-icons">eco</i>
		<span class="app-menu__label">مدیریت سبز</span>
	</a>
</li>

<li>
	<a class="app-menu__item @if(rn() == 'branch.index') active @endif" href="{{route("branch.index")}}">
		<i class="ml-2 material-icons">account_tree</i>
		<span class="app-menu__label">مدیریت شعب</span>
	</a>
</li>

<li>
	<a class="app-menu__item @if(rn() == 'category.index') active @endif" href="{{route("category.index")}}">
		<i class="ml-2 material-icons">category</i>
		<span class="app-menu__label">دسته بندی شاخص های ارزیابی</span>
	</a>
</li>

<li>
	<a class="app-menu__item @if(rn() == 'indicator.index') active @endif" href="{{route("indicator.index")}}">
		<i class="ml-2 material-icons">show_chart</i>
		<span class="app-menu__label">مدیریت شاخص ها</span>
	</a>
</li>

@endmaster

@branch
<li>
	<a class="app-menu__item @if(rn() == 'consumption.index') active @endif" href="{{route("consumption.index")}}">
		<i class="ml-2 material-icons">timeline</i>
		<span class="app-menu__label"> گزارش مصرف </span>
	</a>
</li>
@endbranch
