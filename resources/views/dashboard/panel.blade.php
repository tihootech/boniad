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
		<span class="app-menu__label">مدیریت بنیاد ها</span>
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

<li>
	<a class="app-menu__item @if(rn() == 'eval.list') active @endif" href="{{route("eval.list")}}">
		<i class="ml-2 material-icons">donut_large</i>
		<span class="app-menu__label"> ارزیابی </span>
	</a>
</li>

@master
<li>
	<a class="app-menu__item @if(rn() == 'report') active @endif" href="{{route("report")}}">
		<i class="ml-2 material-icons">assignment_turned_in</i>
		<span class="app-menu__label"> گزارش گیری </span>
	</a>
</li>
@endmaster
