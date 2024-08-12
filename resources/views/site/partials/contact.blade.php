<?php
    $users = \App\Model\Admin\Consultant::query()->latest()->get();
?>
<div class="support-popup">
    <i class="fa fa-window-close" aria-hidden="true"></i>
    @foreach($users as $user)
        <div id="support-item" class="supporter-item">
            <div class="info">
                <div class="support-rt"><span
                        class="name-support">{{$user->name}}</span>
                    <span
                        class="phone-support phone-support_2 phone_support_3"><a
                            href=tel:{{$user->phone}}>{{$user->phone}}</a></span>
                </div>
            </div>
        </div>
    @endforeach
</div>