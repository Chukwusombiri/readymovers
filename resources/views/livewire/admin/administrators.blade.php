<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center flex-wrap">
                <h6 class="">Administrators table</h6>
                <a href="{{ route('administrator.new') }}" class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">create new</a>
            </div>
            <div class="my-10 w-full px-4 flex items-center">
                <div class="w-full relative border h-12 shadow p-4 rounded-full flex items-center">
                    <input type="text" wire:model="search" class="w-full appearance-none border-none outline-none focus:outline-none focus:border-none focus:ring-transparent" placeholder="Filter by Name, email">
                    <button wire:click="clear" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-x-filled text-gray-500 hover:text-gray-600 h-7 w-7 fill-current" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 2l.324 .001l.318 .004l.616 .017l.299 .013l.579 .034l.553 .046c4.785 .464 6.732 2.411 7.196 7.196l.046 .553l.034 .579c.005 .098 .01 .198 .013 .299l.017 .616l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.464 4.785 -2.411 6.732 -7.196 7.196l-.553 .046l-.579 .034c-.098 .005 -.198 .01 -.299 .013l-.616 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.785 -.464 -6.732 -2.411 -7.196 -7.196l-.046 -.553l-.034 -.579a28.058 28.058 0 0 1 -.013 -.299l-.017 -.616c-.003 -.21 -.005 -.424 -.005 -.642l.001 -.324l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.464 -4.785 2.411 -6.732 7.196 -7.196l.553 -.046l.579 -.034c.098 -.005 .198 -.01 .299 -.013l.616 -.017c.21 -.003 .424 -.005 .642 -.005zm-1.489 7.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" fill="currentColor" stroke-width="0" />
                        </svg>
                    </button>
                </div>
            </div>            
            <x-alert />
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table
                        class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Name</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    contact</th>
                                <th
                                    class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Status</th>
                                <th
                                    class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Suspended</th>
                                <th
                                    class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Registered</th>
                                <th
                                    class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Last activity</th>
                                <th
                                    class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($search=='')
                            <tr>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div>
                                            @if (auth('admin')->user()->profile_photo_path!==null)
                                            <img src="{{asset('storage/'.auth('admin')->user()->profile_photo_path)}}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="inline-flex items-center justify-center mr-4 h-9 w-9">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>   
                                            @endif
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal">You
                                            </h6>
                                            <p
                                                class="uppercase mb-0 text-xs leading-tight text-slate-400">                                                
                                                {{str_replace('_',' ',auth('admin')->user()->admin_role)}}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p
                                        class="mb-0 text-xs font-semibold leading-tight">
                                        {{auth('admin')->user()->email}}</p>
                                    <p
                                        class="mb-0 text-xs leading-tight text-slate-400">
                                        {{auth('admin')->user()->phone ?? '---'}}</p>
                                </td>
                                <td
                                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Active</span>                                
                                </td>
                                <td
                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">                                    
                                    <span class="text-xs font-semibold leading-tight text-sky-600">Not suspended</span> 
                                </td>
                                <td
                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">                                           
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{date('M d, Y | h:i k',strtotime(auth('admin')->user()->created_at))}}</span>                                            
                                </td>
                                <td
                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{auth('admin')->user()->updated_at->diffForHumans()}}</span>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="{{route('subscriber.email',['email' => json_encode([auth('admin')->user()->email])])}}"
                                        class="text-xs font-semibold leading-tight text-slate-500 mr-2 hover:underline">
                                        Email </a>
                                    <a href="{{ route('administrator.edit', [auth('admin')->user()->id]) }}"
                                        class="text-xs font-semibold leading-tight text-sky-500 mr-2 hover:underline">
                                        View </a>
                                    <button wire:click="delete('{{ auth('admin')->user()->id }}')"
                                        class="hover:underline text-xs text-rose-600 font-semibold leading-tight">Delete</button>
                                </td>
                            </tr>  
                            @endif                            
                            @if (count($admins) > 0)
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    @if ($admin->profile_photo_path!==null)
                                                    <img src="{{asset('storage/'.$admin->profile_photo_path)}}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                                                    @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="inline-flex items-center justify-center mr-4 h-9 w-9">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>   
                                                    @endif
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal">{{$admin->name}}
                                                    </h6>
                                                    <p
                                                        class="uppercase mb-0 text-xs leading-tight text-slate-400">                                                        
                                                        {{str_replace('_',' ',$admin->admin_role)}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight">
                                                {{$admin->email}}</p>
                                            <p
                                                class="mb-0 text-xs leading-tight text-slate-400">
                                                {{$admin->phone ?? '---'}}</p>
                                        </td>
                                        <td
                                            class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            @if ($admin->isOnline)
                                            <span
                                            class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Online</span>
                                            @else
                                            <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Offline</span>
                                            @endif
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            @if ($admin->isSuspended)
                                            <span class="text-xs font-semibold leading-tight text-rose-600">Suspended</span>
                                            @else
                                            <span class="text-xs font-semibold leading-tight text-sky-600">Not suspended</span>  
                                            @endif
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">                                           
                                            <span class="text-xs font-semibold leading-tight text-slate-400">{{date('M d, Y | h:i k',strtotime($admin->created_at))}}</span>                                            
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400">{{$admin->updated_at->diffForHumans()}}</span>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="{{route('subscriber.email',['email' => json_encode([$admin->email])])}}"
                                                class="text-xs font-semibold leading-tight text-slate-500 mr-2 hover:underline">
                                                Email </a>
                                            <a href="{{ route('administrator.edit', [$admin->id]) }}"
                                                class="text-xs font-semibold leading-tight text-sky-500 mr-2 hover:underline">
                                                View </a>
                                            <button wire:click="delete('{{ $admin->id }}')"
                                                class="hover:underline text-xs text-rose-600 font-semibold leading-tight">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div><div class="p-4">
                    {{$admins->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
