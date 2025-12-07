<div>
    <div class="flex flex-wrap justify-center -mx-3">
        {{-- admin details --}}
        <div class="w-full max-w-full px-3 shrink-0 md:w-9/12 md:flex-0">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-6">
                    <p class="leading-normal uppercase text-sm">User Information</p>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full flex items-center flex-wrap">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    @if ($newPhoto)
                                        <p class="block mb-2 ml-1 font-bold text-xs text-slate-700">
                                            Photo preview</p>
                                        <img src="{{ $newPhoto->temporaryUrl() }}" alt="New photo preview"
                                            class="w-32 h-32 rounded-full">
                                    @else
                                        <p class="block mb-2 ml-1 font-bold text-xs text-slate-700">
                                            Profile photo</p>
                                        @if ($admin->profile_photo_path !== null)
                                            <img src="{{ url('storage/' . $admin->profile_photo_path) }}"
                                                alt="Profile photo" class="w-32 h-32 rounded-full">
                                        @else
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-32 h-32">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </span>
                                        @endif
                                    @endif
                                    <div class="w-full max-w-full flex mt-4">
                                        <label for="newPhoto"
                                            class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                            {{ $admin->profile_photo_path !== null ? 'Change photo' : 'Upload photo' }}
                                        </label>
                                        <input type="file" wire:model="newPhoto" id="newPhoto" class="hidden" />
                                        <x-input-error for="newPhoto" />
                                    </div>
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="w-full max-w-full">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Full
                                            Name</label>
                                        <input type="text" wire:model="name" id="name"
                                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                        <x-input-error for="name" />
                                    </div>
                                </div>
                                <div class="w-full max-w-full">
                                    <div class="mb-4">
                                        <label for="email"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Email
                                            address</label>
                                        <input type="email" wire:model="email" id="email"
                                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                        <x-input-error for="email" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                            <div class="mb-4">
                                <label for="phone"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Phone
                                    number</label>
                                <input type="text" wire:model="phone" id="phone"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                <x-input-error for="phone" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                            <div class="mb-4">
                                <label for="admin_role"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Admin
                                    Role</label>
                                <select wire:model="admin_role" id="admin_role"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                    @foreach ($roles as $key => $role)
                                        <option value="{{ $role }}"
                                            @if ($admin_role == $role) {{ 'selected' }} @endif>
                                            {{ $key }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="admin_role" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:flex-0 flex justify-end">
                            <button wire:click="saveUserDetails" type="button"
                                class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">save</button>
                        </div>
                    </div>
                    <hr
                        class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent" />

                    <p class="leading-normal uppercase text-sm">Language Information</p>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3">
                            <div class="mx-auto max-w-4xl">
                                <div class="mt-4">
                                    <div class="mb-4">
                                        <div>
                                            <p
                                                class="inline-block mb-2 ml-1 font-bold text-sm text-slate-700">
                                                Spoken Languages</p>
                                            <div class="flex flex-wrap mb-6">
                                                @foreach ($spoken_languages as $i => $sl)
                                                    <div
                                                        class="inline-flex items-center overflow-hidden rounded-md border bg-white mr-1 mb-2">
                                                        <span
                                                            class="border-e px-4 py-2 text-sm/none text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                                                            {{ $sl }}
                                                        </span>

                                                        <button wire:click="removeLanguage({{ $i }})"
                                                            class="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                                                            <span class="sr-only">remove language</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18 18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <p
                                                class="block mb-2 ml-1 font-bold text-sm text-slate-700">
                                                Languages</p>
                                            <div class="mt-4 md:flex items-center flex-wrap">
                                                @foreach ($validLanguages as $item)
                                                    <div class="mb-2 mr-4">
                                                        <x-label for="{{ $item }}">
                                                            <div class="flex items-center">
                                                                <input type="checkbox" wire:model="spoken_languages"
                                                                    value="{{ $item }}"
                                                                    id="{{ $item }}" required
                                                                    @if (in_array($item, $spoken_languages)) {{ 'checked' }} @endif />

                                                                <div class="ml-2">
                                                                    {{ $item }}
                                                                </div>
                                                            </div>
                                                        </x-label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <x-input-error for="spoken_languages" />
                                        </div>

                                        <label for="otherLang"
                                            class="inline-block mt-4 mb-2 ml-1 font-bold text-sm text-slate-700">Other
                                            Language</label>
                                        @if (session('otherLang'))
                                            <p class="text-emerald-500 font-semibold text-sm p-2">
                                                {{ session('otherLang') }}</p>
                                        @endif
                                        <div class="flex flex-nowrap mb-2">
                                            <input type="text" id="otherLang" wire:model="otherLang"
                                                placeholder="Enter other language (optional)"
                                                class="w-7/12 px-4 py-2 rounded-l-lg focus:shadow-primary-outline text-sm leading-5.6 ease appearance-none border-solid border-gray-300 bg-white bg-clip-padding font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:ring-0 focus:outline-none">
                                            <button type="button" wire:click='addLanguage'
                                                class="px-7 py-2 rounded-r-lg font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 cursor-pointer text-xs bg-slate-700 hover:shadow-xs active:opacity-85">
                                                Add
                                            </button>
                                        </div>
                                        <x-input-error for="otherLang" />
                                    </div>
                                    <div class="flex justify-end pt-8">
                                        <button wire:click="saveLanguage" type="button"
                                            class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Bio data --}}
    <div class="flex flex-wrap justify-center -mx-3 mt-6">
        <div class="w-full max-w-full px-3 shrink-0 md:w-9/12">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-6">
                    <p class="leading-normal uppercase text-sm">Other Bio Data</p>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4">
                                <label for="age"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Age</label>
                                <input type="number" wire:model="age" id="age"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                <x-input-error for="age" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4">
                                <label for="marital_status"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Marital
                                    Status</label>
                                <select wire:model="marital_status" id="marital_status"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                    <option value="">Choose marital status</option>
                                    @foreach ($maritalStatuses as $item)
                                        <option value="{{ $item }}"
                                            @if ($item === $marital_status) {{ 'selected' }} @endif
                                            class="uppercase">{{ $item }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="marital_status" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4">
                                <label for="gender"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Gender</label>
                                <select wire:model="gender" id="gender"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                    <option value="">Choose gender</option>
                                    @foreach ($genders as $element)
                                        <option value="{{ $element }}"
                                            @if ($element === $gender) {{ 'selected' }} @endif
                                            class="uppercase">{{ $element }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="gender" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                            <div class="mb-4">
                                <label for="bio"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Bio</label>
                                <textarea wire:model="bio" id="bio" rows="5"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></textarea>
                                <x-input-error for="bio" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                            <div class="mb-4">
                                <label for="address"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Address</label>
                                <input type="text" wire:model="address" id="address"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                <x-input-error for="address" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                            <div class="mb-4">
                                <label for="city"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">City</label>
                                <input type="text" wire:model="city" id="city"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                <x-input-error for="city" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4">
                                <label for="country"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Country
                                    of residence</label>
                                <input type="text" wire:model="country" id="country"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                <x-input-error for="country" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4">
                                <label for="nationality"
                                    class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nationality</label>
                                <input type="text" wire:model="nationality" id="nationality"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                <x-input-error for="nationality" />
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4">
                                <p class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                    Account status</p>
                                <x-label for="isSuspended">
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="isSuspended" id="isSuspended"
                                            class="size-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                                        <div class="ml-2">
                                            Is admin suspended?
                                        </div>
                                    </div>
                                </x-label>
                                <x-input-error for="isSuspended" />
                            </div>
                        </div>
                        @if ($admin->cv_path)
                            <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                <div class="mb-4">
                                    <p
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                        Curriculum Vitae</p>
                                    <button wire:click="viewCv" type="button"
                                        class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">view
                                        cv</button>
                                </div>
                            </div>
                        @endif
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                            <div class="mb-4 relative">
                                <label title="Click to upload" for="cv"
                                    class="cursor-pointer flex items-center m-4 gap-4 px-4 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                    <div class="w-max relative">
                                        <img class="w-12" src="{{ asset('images/upload-circle.svg') }}"
                                            alt="file upload icon" width="14" height="14">
                                    </div>
                                    <div class="relative">
                                        <span
                                            class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">{{ $admin->cv_path ? 'Replace' : 'Upload' }}
                                            CV</span>
                                        <span class="mt-0.5 block text-sm text-gray-500">Max 2 MB</span>
                                    </div>
                                </label>
                                <input type="file" wire:model="cv" id="cv" class="hidden">
                                <x-input-error for="cv" />
                            </div>
                        </div>
                        @if ($this->cv)
                            <div
                                class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0 md:flex md:flex-col md:justify-center">
                                <div class="mb-4 relative text-emerald-500 font-semibold text-sm">
                                    New file selected
                                </div>
                            </div>
                        @endif
                        <div class="w-full mt-4 flex justify-end pt-4">
                            <button wire:click="saveOtherDetails" type="button"
                                class="px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
