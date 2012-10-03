#!/usr/bin/env python

import sys,os,re
from subprocess import *

##if len(sys.argv)<=1:
##  print "usage: python oneinn.py filename frames"
##  sys.exit(0)
##
##try:
##  fvideo = sys.argv[1]
##  frames = float(sys.argv[2])
##except:
##  sys.stderr.write("Failed to parse parameters.\n")
##  sys.exit(1)
##
##output = Popen(["ffmpeg", "-i", fvideo], stderr=PIPE).communicate()
##
### searching and parsing "Duration: 00:05:24.13," from ffmpeg stderr, ignoring the centiseconds
##re_duration = re.compile("Duration: (.*?)\.")
##duration = re_duration.search(output[1]).groups()[0]
##
##seconds = reduce(lambda x,y:x*60+y,map(int,duration.split(":")))
##rate = frames/seconds
##
##print "Duration = %s (%i seconds)" % (duration, seconds)
##print "Capturing one frame every %.1f seconds" % (1/rate)
##
##output = Popen(["ffmpeg", "-i", fvideo, "-r", str(rate), "-s", "100x100", "-vcodec", "png", 'Preview-%05d.png']).communicate()

print "Converting to a gif"
output = Popen(["convert", "-delay", "10", "-loop", "0", "Preview-*.png", "anim.gif"]).communicate()


