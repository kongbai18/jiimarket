Page({

  /**
   * 页面的初始数据
   */
  data: {
    curNav:0
  },
  selectNav:function(event) {//event.target.dataset. 获取事件中的数据
    var id = event.target.dataset.id,
        self = this;
    if(self.data.curNav == id){
      self.setData({
        curNav: 0,
      })
    }else{
      self.setData({
        curNav: id,
      })
    }    
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var self = this
    wx.request({
      url: 'http://jiihome.free.ngrok.cc/jiiMarket/index.php/Home/index/getCate',
      success: function (res) {
          self.setData({
            cateData: res.data,
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
    
  },
})