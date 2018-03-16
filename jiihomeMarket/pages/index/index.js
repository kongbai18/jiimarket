Page({

  /**
   * 页面的初始数据
   */
  data: {
    imgUrls: [
      'http://static.jiihome.com/views/default/skin/default/images/home/banner1.png?',
      'http://static.jiihome.com/views/default/skin/default/images/home/changjingbanner.png?',
      'http://static.jiihome.com/views/default/skin/default/images/home/changjingbanner.png?'
    ],
    indicatorDots: true,
    autoplay: true,
    circular:true,
    interval: 3000,
    duration: 500
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    wx.login({
      success: function (res) {
        console.log(res.code)
        var code = res.code
        wx.request({
          url: 'https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code', 
          data: {
            appid:'wxf8907d405e09a9c0',
            secret:'05ff0ab92bfd0277a3d2f5ac20bfea42',
            js_code: code,
            grant_type: 'authorization_code'
          },
          success: function (res1) {
            console.log(res1.data)
          }
        })
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
    
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
    
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
    
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
    
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
    
  }
})