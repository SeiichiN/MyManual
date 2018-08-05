// list2-7.swift
/*
 * ひと月のカレンダーを印字する
 * @param: Int fday (label first) -- 最初に日の曜日（0:日曜）
 *         Inf days               -- その月の日数
 */
func printMonth(first fday:Int, days:Int) {
    var d = 1 - fday
    /*
     * 1日分のスペースをつくりだす関数
     */
    func daystr() -> String {
        if d <= 0 {                       // 1日になるまでは、マイナス。
            return "    "                 // 1日までを空白でうめる
        } else {
            return (d < 10 ? "   \(d)" : "  \(d)")  // ひと桁の場合と2桁の場合
        }
    }

    while d <= days {
        var line = ""
        for _ in 0 ..< 7 {
            line += daystr()
            d += 1
            if d > days { break }
        }
        print(line)
    }
}

printMonth(first:3, days:31)
