<view qq:if="{{user != null}}" class="content">
  <form bindsubmit="formSubmit">
    <input type="number" placeholder="输入手机号码" maxlength="11" name="mobile" bindinput="bind_key_input" class="mobile" />
    <view class="code clearfix">
      <input type="number" placeholder="验证码" maxlength="4" name="verify" class="verify" />
      <button type="default" hover-class="none" size="mini" loading="{{verify_loading}}" disabled="{{verify_disabled}}" bindtap="verify_send" class="verify-sub {{verify_disabled ? 'sub-disabled' : ''}}">{{verify_submit_text}}</button>
    </view>
    <button type="default" formType="submit" hover-class="none" plain loading="{{form_submit_loading}}" disabled="{{form_submit_loading}}" class="submit {{form_submit_loading ? 'my-btn-gray' : 'my-btn-default'}}">确认绑定</button>
  </form>
</view>

<view qq:if="{{user == null}}" class="user-login tc">
  <view class="cr-888 fs-12">确认登录授权，为您提供更优质的服务</view>
  <button type="primary" size="mini" open-type="getUserInfo" bindgetuserinfo="get_user_info_event">授权登录</button>
</view>
