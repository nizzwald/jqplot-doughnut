jqplot-doughnut
===============

Using jqplot's AJAX/JSON API w/redraw

I wanted to try some graphing tools.  Tried a few but worked best with jqplot. Here I do a DB query for some Olympic medals by country (country selected via dropdown).  Results are set to a jqplot compliant JSON array (not object - sucks) and returned to the jqplot object.  jqplot's redraw() is invoked in order to update the graph in real-time and so that it isn't overwritten - if redraw isn't invoked, the graph will update on top of each other.
