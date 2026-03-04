@props()





<div class="card bg-base-100 shadow mt-8">
    <div class="card-body">
        <div class="flex space x-3">
            @if ($chirp ->user)
                <div class="avatar ">
                    <div class="size-10 rounded-full">
                        <img src="" />
                    </div>                
                </div>
            </div>
            @else
            <div class="avatar placeholder">
                <div class="size-10 rounded-full">
                    <img src="" />

                </div>
            </div>         
            @endif 
        </div>
    </div>
</div>
