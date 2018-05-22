using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Diagnostics;
using System.Xml.Linq;
using System.Xml.XPath;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            var uri = new UriBuilder(textBox1.Text);
            uri.Scheme = "mmsh";
            var proc = new Process();
            proc.StartInfo.FileName = "ffprobe";
            proc.StartInfo.Arguments = $"-loglevel quiet -show_streams -print_format xml -i {uri.ToString()}";
            proc.StartInfo.UseShellExecute = false;
            proc.StartInfo.RedirectStandardOutput = true;
            proc.Start();
            var xml = XDocument.Parse(proc.StandardOutput.ReadToEnd());
            var stream = xml.XPathSelectElement("//stream");
            var start_pts = stream.Attribute("start_pts");
            var start_time = (DateTimeOffset.UtcNow.ToUnixTimeMilliseconds() - int.Parse(start_pts.Value) - 10000) / 1000;
            uri.Scheme = "httpt";
            textBox2.Text = $"http://auto.meto4d.pgw.jp/kagamin/tsukasa.asx?start_time={start_time}&ref={Uri.EscapeDataString(uri.ToString())}";
        }
    }
}
