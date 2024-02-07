<!-- Modal -->
<div class="modal fade" id="{{isset($mainmenu)?$mainmenu:''}}SubmenuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl pt-5 " id="{{isset($mainmenu)?$mainmenu:''}}Out">
    <div class="modal-content grid grid-cols-2 divide-x">
        <div class="modal-body">
            <ul class="flex flex-wrap items-center m-auto px-2.5">
                
                @if (isset($menu))
                    @foreach ($menu as $submenu)
                        <li class="m-2">
                            <a href="{{ $submenu->link }}" class="flex items-center md:w-60 w-40 bg-white border border-gray-300 rounded-lg shadow-md max-w-xs px-6 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <img src="{{url('/images/submenu/dashboard_icon.png')}}" width="20px" alt="" srcset="">
                                <span class="m-2">{{ $submenu->submenu_name }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                
            </ul>
        </div>
        <div class="images">
            <span>
                <img src="https://source.unsplash.com/random/640x454/?nature,ocean,blue" alt="">
            </span>
        </div>
    </div>
</div>
</div>