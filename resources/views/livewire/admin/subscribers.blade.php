<div class="flex flex-wrap -mx-3">    
    <div class="flex-none w-full max-w-full px-3">        
        <div
            class="relative mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center flex-wrap">
                <h6 class="dark:text-white">Mail List table</h6>   
                <button type="button" wire:click="sendToMany"
                  class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Send to Many</button>                             
            </div>
            <x-alert />
            <div class="my-10 w-full px-4 flex items-center">
                <div class="w-full relative border h-12 shadow p-4 rounded-full flex items-center">
                    <input type="text" wire:model="search" class="w-full appearance-none border-none outline-none focus:outline-none focus:border-none focus:ring-transparent" placeholder="Filter by email">
                    <button wire:click="clear" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-x-filled text-gray-500 hover:text-gray-600 h-7 w-7 fill-current" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 2l.324 .001l.318 .004l.616 .017l.299 .013l.579 .034l.553 .046c4.785 .464 6.732 2.411 7.196 7.196l.046 .553l.034 .579c.005 .098 .01 .198 .013 .299l.017 .616l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.464 4.785 -2.411 6.732 -7.196 7.196l-.553 .046l-.579 .034c-.098 .005 -.198 .01 -.299 .013l-.616 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.785 -.464 -6.732 -2.411 -7.196 -7.196l-.046 -.553l-.034 -.579a28.058 28.058 0 0 1 -.013 -.299l-.017 -.616c-.003 -.21 -.005 -.424 -.005 -.642l.001 -.324l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.464 -4.785 2.411 -6.732 7.196 -7.196l.553 -.046l.579 -.034c.098 -.005 .198 -.01 .299 -.013l.616 -.017c.21 -.003 .424 -.005 .642 -.005zm-1.489 7.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" fill="currentColor" stroke-width="0" />
                          </svg>
                    </button>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table
                        class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Email Address</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Date Added</th>                                
                                <th
                                    class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($subscribers)>0)
                                @foreach ($subscribers as $sub => $subscriber)
                                <tr>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1 items-center"> 
                                            <x-checkbox wire:model='recipients' value="{{$subscriber->email}}"/>                                           
                                            <div class="ml-2 flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">{{$subscriber->email}}</h6>                                                
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span
                                            class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{date('M d, Y | H:i',strtotime($subscriber->created_at))}}</span>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <a href="{{route('subscriber.email',['email'=>json_encode([$subscriber->email])])}}"
                                            class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-sky-500 mr-2 hover:underline">
                                            Email </a>                                        
                                        <button wire:click="delete('{{$subscriber->id}}')" class="hover:underline text-xs text-rose-600 font-semibold leading-tight">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif                            
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{$subscribers->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
