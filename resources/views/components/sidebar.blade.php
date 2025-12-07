<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
  <div class="h-19 bg-green-100 flex items-center">
    <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
    <a class="block px-8 m-0 text-sm whitespace-nowrap text-slate-700" href="{{route('admin_home')}}">
      <x-application-mark class="h-24 w-auto transition-all duration-200 ease-nav-brand"/>
    </a>
  </div>

  <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

  <div class="items-center block w-auto min-h-screen overflow-auto h-sidenav grow basis-full">
    <ul class="flex flex-col pl-0 mb-0">
      <li class="w-full">
        <a class="@if(request()->routeIs('admin_home')) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7  text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('admin_home')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
        </a>
      </li>
      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('orders') || strpos(request()->route()->getName(),'order')!==false) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('orders')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Moving Jobs</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('categories') || strpos(request()->route()->getName(),'categor')!==false) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('categories')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-basket"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Categories</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('inquiries') || strpos(request()->route()->getName(),'inquiries')!==false) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('inquiries')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Inquiries</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('administrators') || strpos(request()->route()->getName(),'administrators')!==false) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('administrators')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-cyan-500 ni ni-app"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Administrators</span>
        </a>
      </li>

      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('subscribers') || strpos(request()->route()->getName(),'subscriber')!==false) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('subscribers')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-red-600 ni ni-single-copy-04"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Mail List</span>
        </a>
      </li>        

      <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Account</h6>
      </li>

      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('admin_profile')) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('admin_profile')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profile</span>
        </a>
      </li>
      <li class="mt-0.5 w-full">
        <a class="@if(request()->routeIs('admin.password.change')) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{route('admin.password.change')}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-sm leading-normal ni ni-lock-circle-open text-emerald-500"></i>
          </div>
          <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Password</span>
        </a>
      </li>
      <li class="mt-0.5 w-full">
        <form action="{{route('admin_logout')}}" method="POST">
          @csrf
          <button type="submit" class="@if(request()->routeIs('logout')) rounded-lg font-semibold text-slate-700 bg-blue-500/13 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-button-power"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Sign Out</span>
          </button>
        </form>          
      </li>        
    </ul>
  </div>    
</aside>