var c = {
  'b': 3,
  'c': function() {
     window.setTimeout(
        () => {
          this.d();
        }, 4);
     },
  'd': function() {
     alert(this.b);
  }
};
 
c.c();