#!/usr/bin/env python
GIFFrames=5
GifFrameDelay=75
maxdimensions=[533, 315]

import sys,os,re
from subprocess import *

if len(sys.argv)<=1:
  print "usage: convert.py filename"
  sys.exit(0)

try:
  fvideo = sys.argv[1]
except:
  sys.stderr.write("Failed to parse parameters.\n")
  sys.exit(1)

output = Popen(["ffmpeg", "-i", fvideo], stderr=PIPE).communicate()

# searching and parsing "Duration: 00:05:24.13," from ffmpeg stderr, ignoring the centiseconds
re_duration = re.compile("Duration: (.*?)\.")
duration = re_duration.search(output[1]).groups()[0]
seconds = reduce(lambda x,y:x*60+y,map(int,duration.split(":")))
rate = float(GIFFrames)/seconds

re_size = re.compile("Stream .* Video: .* (\d+x\d+)")
size = map(int, re_size.search(output[1]).groups()[0].split("x"))

scalefactor = max([float(size[0])/maxdimensions[0], float(size[1])/maxdimensions[1]])
scaledsize = map(lambda x: int(x / scalefactor), size)

print "Size = %ix%i" % (size[0], size[1])
print "Scaled Size = %ix%i" % (scaledsize[0], scaledsize[1])
print "Duration = %s (%i seconds)" % (duration, seconds)
print "Capturing one frame every %.1f seconds of playback" % (1/rate)

#output = Popen(["ffmpeg", "-i", fvideo, "-r", str(rate), "-s", str(scaledsize[0])+"x"+str(scaledsize[1]), "-vcodec", "png", 'Preview-%05d.png']).communicate()

print "Converting to a gif"
output = Popen(["convert", "-delay", str(GifFrameDelay), "-loop", "0", "-layers", "optimize", "Preview-*.png", "anim.gif"]).communicate()


