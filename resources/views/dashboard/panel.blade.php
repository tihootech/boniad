{{-- @php
	$hrefs = ['owners/operator', 'owners/organ'];
@endphp
<li class="treeview @if(expanded($hrefs)) is-expanded @endif">
	<a class="app-menu__item" href="#" data-toggle="treeview">
		<i class="app-menu__icon fa fa-users"></i>
		<span class="app-menu__label"> مدیریت کاربران </span>
		<i class="treeview-indicator fa fa-angle-left"></i>
	</a>
	<ul class="treeview-menu">
		<li>
			<a class="treeview-item @if(active($hrefs[0])) active @endif" href="{{url($hrefs[0])}}">
				<i class="icon fa fa-user-secret"></i> مدیریت مددکارها
			</a>
		</li>
		<li>
			<a class="treeview-item @if(active($hrefs[1])) active @endif" href="{{url($hrefs[1])}}">
				<i class="icon fa fa-bank"></i> مدیریت موسسات
			</a>
		</li>
	</ul>
</li> --}}

<li>
	<a class="app-menu__item @if(rn() == 'branch.index') active @endif" href="{{route("branch.index")}}">
		<i class="ml-2 material-icons">device_hub</i>
		<span class="app-menu__label">مدیریت شعب</span>
	</a>
</li>

<li>
	<a class="app-menu__item @if(rn() == 'category.index') active @endif" href="{{route("category.index")}}">
		<i class="ml-2 material-icons">category</i>
		<span class="app-menu__label">دسته بندی شاخص های ارزیابی</span>
	</a>
</li>
