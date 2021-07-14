<!--删除用户框       <span></span>行标签-->
<div class="am-modal am-modal-confirm" tabindex="-1" id="delete-user">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">删除用户</div>
        <div class="am-modal-bd">你，确定要删除<span id="confirm-username"></span> 这条记录吗？
            <input type="hidden" id="delete-id" />
            <input type="hidden" id="myname" value={{Auth::user()->username}}/>
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel>取消</span> <span
                    class="am-modal-btn" data-am-modal-confirm onclick="deleteuser()">确定</span>
        </div>
    </div>
</div>